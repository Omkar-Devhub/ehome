<?php

namespace App\Http\Controllers\Agent;

use Exception;
use App\Models\Agent;
use App\Models\County;
use Illuminate\Http\Request;
use App\Models\VendorRequest;
use App\Models\VendorInvitation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AgentRegistrationController extends Controller
{
    public function index($token)
    {
        $invitation = VendorInvitation::where('token', $token)->firstOrFail();
        $vendor = VendorRequest::where('email', $invitation->email)->first();

        if ($invitation->expires_at->isPast()) {
            abort(410, 'This invitation link has expired.');
        }

        if ($invitation->registered_at) {
            abort(410, 'This invitation has already been used.');
        }

        $counties = County::where('status', '1')->get();
        return view('frontend.agent.index', compact('invitation', 'counties', 'vendor'));
    }

    public function register($token, Request $request)
    {
        $invitation = VendorInvitation::where('token', $token)->firstOrFail();
        if ($invitation->isExpired() || $invitation->registered_at) {
            abort(410, 'Invalid invitation link.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:agents',
            'phone' => 'required|min:10',
            'role' => 'required',
            'business_type' => 'required',
            'company_name' => 'required',
            'psra_license_number' => 'required',
            'license_expiry_date' => 'required',
            'vat_registration_number' => 'required',
            'company_registration_number' => 'required',
            'business_email' => 'required|email',
            'business_phone' => 'required',
            'description' => 'required',
            'address' => 'required',
            'county_id' => 'required',
            'area_id' => 'required',
            'eircode' => 'required',
            'terms_accepted' => 'required',
            'gdpr_accepted' => 'required',
        ]);

        $validator->after(function ($validator) {
            if (!request()->has('terms_accepted')) {
                $validator->errors()->add('terms_accepted', 'You must accept terms and conditions.');
            }
            if (!request()->has('gdpr_accepted')) {
                $validator->errors()->add('gdpr_accepted', 'You must accept GDPR.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $invitation = VendorInvitation::where('token', $token)->firstOrFail();
        $invitation->registered_at = now();
        $invitation->save();

        if ($request->profile_picture) {
            $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imageName = rand(1111111, 9999999) . "_" . time() . '.' . $request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('uploads/agent/profile_images'), $imageName);
            $agent_profile_picture = $imageName;
        }

        if ($request->company_logo) {
            $request->validate([
                'company_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imageName = rand(1111111, 9999999) . "_" . time() . '.' . $request->company_logo->getClientOriginalExtension();
            $request->company_logo->move(public_path('uploads/agent/company_logos'), $imageName);
            $agent_company_logo = $imageName;
        }

        Agent::create([
            'full_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'profile_picture' => $agent_profile_picture ?? '',
            'role' => $request->role,
            'business_type' => $request->business_type,
            'company_name' => $request->company_name,
            'company_logo' => $agent_company_logo ?? '',
            'psra_license_number' => $request->psra_license_number,
            'license_expiry_date' => $request->license_expiry_date,
            'vat_registration_number' => $request->vat_registration_number,
            'company_registration_number' => $request->company_registration_number,
            'business_email' => $request->business_email,
            'business_phone' => $request->business_phone,
            'description' => $request->description,
            'office_address' => $request->address,
            'county_id' => $request->county_id,
            'area_id' => $request->area_id,
            'eircode' => $request->eircode,
            'terms_accepted' => $request->has('terms_accepted') ? '1' : '0',
            'gdpr_accepted' => $request->has('gdpr_accepted') ? '1' : '0',
            'email_verified' => '1',
            'status' => '0',
        ]);

        VendorRequest::where('email', $request->email)->delete();
        return redirect()->route('vendor.login')->with(['message' => 'Registration successful! You will receive welcome email with your login details.', 'type' => 'success']);
    }
}
