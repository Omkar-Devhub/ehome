<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('backend.admin.login');
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->withInput($request->only('email'))->with('error', 'Invalid email or password provided.');
        }
    }

    public function forgotPassword()
    {
        return view('backend.admin.forgot_password');
    }

    public function forgotPasswordRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return redirect()->back()->withInput($request->only('email'))->with('error', 'Sorry, we could not find an account with that email address.');
        }

        $token = bin2hex(random_bytes(16));
        $admin->token = $token;
        $admin->update();

        $reset_url = url('/admin/reset-password/' . $token . '/' . $request->email);

        try {
            Mail::to($admin->email)->send(new ForgetPasswordMail($admin->name, $reset_url));
            return redirect()->route('admin.login')->with('success', 'A password reset link has been sent to your email address.');
        } catch (\Exception $e) {
            $admin->token = "";
            $admin->update();
            return redirect()->back()->withInput($request->only('email'))->with('error', 'Failed to send password reset link. Please try again.');
        }
    }

    public function resetPassword($token, $email)
    {
        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if ($admin) {
            return view('backend.admin.reset_password', compact('token', 'email'));
        } else {
            return redirect()->route('admin.login')->with('error', 'Sorry! Password reset link is invalid or has expired.');
        }
    }

    public function resetPasswordProcess(Request $request, $token, $email)
    {
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required,same:password',
        ]);

        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if ($admin) {
            $admin->password = Hash::make($request->password);
            $admin->token = "";
            $admin->update();
            return redirect()->route('admin.login')->with('success', 'Congratulations! Your password has been reset successfully.');
        } else {
            return redirect()->route('admin.login')->with('error', 'Sorry! Password reset link is invalid or has expired.');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'You have been logged out.');
    }

    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }
}
