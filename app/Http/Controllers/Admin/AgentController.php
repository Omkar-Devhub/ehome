<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agent;
use App\Models\Property;
use App\Models\StatusNote;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\AgentWelcomeMail;
use App\Mail\ActionRequiredMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        $agents = Agent::latest();
        // Searching
        if (!empty($request->get('keyword'))) {
            $agents = $agents->where('name', 'like', '%' . $request->get('keyword') . '%')->orWhere('email', 'like', '%' . $request->get('keyword') . '%')->orWhere('phone', 'like', '%' . $request->get('keyword') . '%');
        }
        $agents = $agents->paginate(10);
        return view('backend.admin.agent.index', compact('agents'));
    }

    public function edit($agent_id, Request $request)
    {
        $agent = Agent::findOrFail($agent_id);
        return view('backend.admin.agent.edit', compact('agent'));
    }

    public function update($agent_id, Request $request)
    {
        $agent = Agent::findOrFail($agent_id);

        if ($request->reason != "") {
            StatusNote::create([
                'agent_id' => $agent->id,
                'status' => $request->status,
                'note' => $request->reason,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $subject = "Action Required: Compliance Issue in Your EireHome Agent Registration";
            Mail::to($agent->email)->queue(new ActionRequiredMail($agent->full_name, $agent->email, $subject, $request->reason));
        } else {
            $password = Str::random(10);
            $agent->password = Hash::make($password);
            $subject = "Welcome to EireHome – Your Profile is Now Active!";
            Mail::to($agent->email)->queue(new AgentWelcomeMail($agent->full_name, $agent->email, $subject, $password));
        }


        $agent->status = $request->status;
        $agent->save();
        return redirect()->route('admin.agents')->with('toast', ['message' => 'Agent details updated successfully', 'type' => 'success']);;
    }

    public function delete($agent_id)
    {
        $property_count = Property::where('propertyable_id', $agent_id)->count();
        if ($property_count > 0) {
            return redirect()->route('admin.agents')->with('toast', ['message' => 'Agent has properties and cannot be deleted', 'type' => 'warning']);
        }
        Agent::findOrFail($agent_id)->delete();
        return redirect()->route('admin.agents')->with('toast', ['message' => 'Agent deleted successfully', 'type' => 'success']);
    }
}
