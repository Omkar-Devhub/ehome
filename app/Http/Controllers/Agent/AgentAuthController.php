<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentAuthController extends Controller
{
    public function agentLoginProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $agent = Agent::where('email', $request->email)->first();
        if ($agent) {
            if ($agent->status == 1) {
                if (auth()->guard('agent')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $request->session()->regenerate();
                    return redirect()->intended('agent/dashboard');
                } else {
                    return redirect()->route('vendor.login')->withInput($request->only('email'))->with(['message' => 'Invalid email or password provided.', 'type' => 'danger']);
                }
            } elseif ($agent->status == 2) {
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
        return view('frontend.agent.dashboard');
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
