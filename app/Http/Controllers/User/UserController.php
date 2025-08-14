<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use App\Mail\ForgetPasswordMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,except,id',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'terms' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $token = bin2hex(random_bytes(16));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => $token
        ]);

        $verifiaction_url = url('verify-email/' . $token . "/" . $request->email);
        $subject = "EireHome - Email Verification";
        $info = [
            'name' => $user->name,
            'verification_url' => $verifiaction_url
        ];

        try {
            Mail::to($user->email)->queue(new VerifyEmail($subject, $info));
        } catch (Exception $e) {
            $user->delete();
            return redirect()->route('login')->with(['message' => 'Failed to send verification link. Please try again.', 'type' => 'danger']);
        }

        return redirect()->route('login')->with(['message' => 'Registration Successful a verification link has been sent to your email.', 'type' => 'success']);
    }

    public function verifyEmail(Request $request, $token, $email)
    {

        $user = User::where('email', $email)->where('token', $token)->first();
        if ($user) {
            return view('frontend.email_confirm', compact('token', 'email'));
        } else {
            return redirect()->route('login')->with(['message' => 'Email verification link is invalid or has expired.', 'type' => 'danger']);
        }
    }

    public function verifyEmailConfirm(Request $request)
    {
        $token = $request->token;
        $email = $request->email;
        $user = User::where('email', $email)->where('token', $token)->first();
        if ($user) {
            $user->status = 1;
            $user->token = "";
            $user->update();
            return redirect()->route('login')->with(['message' => 'Email has been verified successfully.', 'type' => 'success']);
        } else {
            return redirect()->route('login')->with(['message' => 'Email verification link is invalid or has expired.', 'type' => 'danger']);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->status == 1) {
                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $request->session()->regenerate();
                    return redirect()->intended('user/dashboard');
                } else {
                    return redirect()->route('login')->withInput($request->only('email'))->with(['message' => 'Invalid email or password provided.', 'type' => 'danger']);
                }
            } elseif ($user->status == 2) {
                return redirect()->route('login')->withInput($request->only('email'))->with(['message' => 'Your Account has been suspended. Please contact support team.', 'type' => 'danger']);
            } else {
                return redirect()->route('login')->withInput($request->only('email'))->with(['message' => 'Email has not been verified yet. Please check your inbox.', 'type' => 'danger']);
            }
        } else {
            return redirect()->route('login')->withInput($request->only('email'))->with(['message' => 'You are not registered with us. Please register first.', 'type' => 'danger']);
        }
    }

    public function forgotPasswordRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = bin2hex(random_bytes(16));
            $user->token = $token;
            $user->update();
            $reset_url = url('reset-password/' . $token . "/" . $request->email);
            try {
                Mail::to($user->email)->queue(new ForgetPasswordMail($user->name, $reset_url));
            } catch (Exception $e) {
                return redirect()->route('forgot.password')->withInput($request->only('email'))->with(['message' => 'Failed to send password reset link. Please try again.', 'type' => 'danger']);
            }
            return redirect()->route('login')->with(['message' => 'Password reset link has been sent to your email.', 'type' => 'success']);
        } else {
            return redirect()->route('forgot.password')->withInput($request->only('email'))->with(['message' => 'You are not registered with us. Please register first.', 'type' => 'danger']);
        }
    }

    public function resetPassword(Request $request, $token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if ($user) {
            return view('frontend.reset-password', compact('user'));
        } else {
            return redirect()->route('login')->with(['message' => 'Password reset link is invalid or has expired.', 'type' => 'danger']);
        }
    }

    public function resetPasswordUpdate(Request $request, $token, $email)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::where('email', $email)->where('token', $token)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->token = "";
            $user->update();
            return redirect()->route('login')->with(['message' => 'Password has been reset successfully.', 'type' => 'success']);
        } else {
            return redirect()->route('login')->with(['message' => 'Password reset link is invalid or has expired.', 'type' => 'danger']);
        }
    }
}
