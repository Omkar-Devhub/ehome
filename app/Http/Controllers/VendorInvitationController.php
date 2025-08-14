<?php

namespace App\Http\Controllers;

use App\Mail\AgentInvitationMail;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VendorRequest;
use App\Models\VendorInvitation;
use App\Mail\VendorInvitationMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VendorInvitationController extends Controller
{
    public function create($id)
    {
        $vendor_details = VendorRequest::findOrFail($id);
        return view('backend.admin.reg_request.create', compact('vendor_details'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'user_type' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Generate token and expiration (24 hours from now)
        $token = Str::random(32);
        $expiresAt = Carbon::now()->addHours(24);

        VendorInvitation::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'token' => $token,
            'invited_by' => auth()->guard('admin')->user()->id,
            'expires_at' => $expiresAt
        ]);

        if ($request->user_type == 'Vendor') {
            $mailurl = 'vendor.registration';
        } else {
            $mailurl = 'agent.registration';
        }
        // Generate signed URL that expires
        $registrationUrl = URL::temporarySignedRoute(
            $mailurl,
            $expiresAt,
            ['token' => $token]
        );

        try {
            if ($request->user_type == 'Vendor') {
                Mail::to($request->email)->queue(new VendorInvitationMail($registrationUrl, $expiresAt, $request->name));
            } else {
                Mail::to($request->email)->queue(new AgentInvitationMail($registrationUrl, $expiresAt, $request->name));
            }
        } catch (Exception $e) {
            return redirect()->back()->with('toast', ['message' => 'Failed to send invitation. Please try again.', 'type' => 'danger']);
        }

        return redirect()->route('admin.registration-requests')->with('toast', ['message' => 'Invitation sent successfully.', 'type' => 'success']);
    }
}
