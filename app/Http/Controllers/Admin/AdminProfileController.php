<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function index()
    {
        return view('backend.admin.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $admin = Admin::where('id', auth()->guard('admin')->user()->id)->first();

        if($request->profile_image) {
            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ]);

            $imageName = "profile_image_".time() . '.' . $request->profile_image->getClientOriginalExtension();
            $request->profile_image->move(public_path('uploads/profile_images'), $imageName);
            if($admin->photo && file_exists(public_path('uploads/profile_images/' . $admin->photo))) {
                unlink(public_path('uploads/profile_images/' . $admin->photo));
            }
            $admin->photo = $imageName;
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->update();


        return redirect()->route('admin.profile')->with('toast', ['message' => 'Profile updated successfully', 'type' => 'success']);
    }

    public function changePassword()
    {
        return view('backend.admin.change-password');
    }

    public function changePasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $admin = Admin::where('id', auth()->guard('admin')->user()->id)->first();

        if(Hash::check($request->current_password, $admin->password)) {
            $admin->password = Hash::make($request->password);
            $admin->update();
            return redirect()->route('admin.dashboard')->with('toast', ['message' => 'Password updated successfully', 'type' => 'success']);
        } else {
            return redirect()->route('admin.change.password')->with('toast', ['message' => 'Current password does not match', 'type' => 'danger']);
        }
    }
}
