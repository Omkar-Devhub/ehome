<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Support\Facades\Validator;

class VendorAuthController extends Controller
{
    public function vendorLogin()
    {
        return view('frontend.vendor_agent_login');
    }

    public function vendorLoginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $vendor = Vendor::where('email', $request->email)->first();
        if ($vendor) {
            if ($vendor->status == 1) {
                if (auth()->guard('vendor')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $request->session()->regenerate();
                    return redirect()->intended('vendor/dashboard');
                } else {
                    return redirect()->route('vendor.login')->withInput($request->only('email'))->with(['message' => 'Invalid email or password provided.', 'type' => 'danger']);
                }
            } elseif ($vendor->status == 2) {
                return redirect()->route('vendor.login')->withInput($request->only('email'))->with(['message' => 'Your Account has been suspended. Please contact support team.', 'type' => 'danger']);
            } else {
                return redirect()->route('vendor.login')->withInput($request->only('email'))->with(['message' => 'Email has not been verified yet. Please check your inbox.', 'type' => 'danger']);
            }
        } else {
            return redirect()->route('vendor.login')->withInput($request->only('email'))->with(['message' => 'You are not registered with us. Please register first.', 'type' => 'danger']);
        }
    }

    public function dashboard()
    {
        return view('frontend.vendors.index');
    }

    public function vendorForgotPassword()
    {
        return view('frontend.vendor-forgot-password');
    }

    public function logout()
    {
        auth()->guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }
}
