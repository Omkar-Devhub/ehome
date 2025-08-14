<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\County;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Models\VendorRequest;
use App\Mail\VendorWelcomeMail;
use App\Models\VendorInvitation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\VendorRegistrationRequestMail;

class VendorRegistrationController extends Controller
{
    public function showVendorRegistrationForm()
    {
        return view('frontend.vendor-registration-request');
    }

    public function vendorRegistrationRequestSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'reg_type' => 'required',
            'terms' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $registraion_request = VendorRequest::create([
            'reg_type' => $request->reg_type,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($registraion_request) {
            $subject = "EireHome - Vendor Registration Request";
            $info = [
                'reg_type' => ucfirst($request->reg_type),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'submission_date' => Carbon::now()->format('d-m-Y h:i A'),
            ];

            $sales_email = getContactInfo()->sales_email;

            try {
                Mail::to($sales_email)->queue(new VendorRegistrationRequestMail($subject, $info));
            } catch (Exception $e) {
                return redirect()->route('vendor.registration.request')->with(['message' => 'Failed to send registration request. Please try again.', 'type' => 'danger']);
            }
        }

        return redirect()->route('vendor.registration.request')->with(['message' => 'Registration request has been sent successfully', 'type' => 'success']);
    }

    public function showRegistrationForm($token)
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
        return view('frontend.vendor_register', compact('invitation', 'counties', 'vendor'));
    }

    public function vendorRegistrationSubmit(Request $request, $token)
    {
        $invitation = VendorInvitation::where('token', $token)->firstOrFail();

        if ($invitation->isExpired() || $invitation->registered_at) {
            abort(410, 'Invalid invitation link.');
        }

        $validated = Validator::make($request->all(), [
            'county_id' => 'required',
            'area_id' => 'required',
            'eircode' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'vendor_name' => 'required',
            'vat_number' => 'nullable',
            'name' => 'required',
            'email' => 'required|email|unique:vendors,email',
            'password' => 'required|min:8',
            'phone' => 'required',
            'description' => 'required',
            'show_ph' => 'required',
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated->errors())->withInput();
        }
        // dd($request->all());
        Vendor::create([
            'county_id' => $request->county_id,
            'area_id' => $request->area_id,
            'eircode' => $request->eircode,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'company_name' => $request->vendor_name,
            'tax_id' => $request->vat_number,
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'show_phone_number' => $request->has('show_ph') ? '1' : '0',
            'status' => '1',
            'created_at' => Carbon::now(),
        ]);

        $invitation->update(['registered_at' => now()]);

        VendorRequest::where('email', $request->email)->delete();

        try {
            Mail::to($request->email)->queue(new VendorWelcomeMail($request->name, $request->email, 'Welcome to EireHome'));
        } catch (\Exception $e) {
            return redirect()->route('vendor.login')->with(['message' => 'Vendor registration successful but we could not send you an email.', 'type' => 'danger']);
        }
        return redirect()->route('vendor.login')->with(['message' => 'Congratulations! Vendor registration successful', 'type' => 'success']);
    }
}
