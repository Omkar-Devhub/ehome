<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agent;
use App\Models\Agreement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgreementController extends Controller
{
    public function create()
    {
        $agents = Agent::all();
        return view('backend.admin.agreement.create', compact('agents'));
    }

    public function store(Request $request)
    {
        $path = $request->file('agreement')->store('agreements', 'public');

        $token = Str::random(64);

        Agreement::create([
            'agent_id' => $request->agent_id,
            'file_path' => $path,
            'sign_token' => $token,
        ]);

        // Optional: send email with signing link
        // Mail::to($agent->email)->send(new SignAgreementMail($token));

        return back()->with('success', 'Agreement sent to agent.');
    }
}
