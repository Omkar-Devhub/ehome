<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Models\County;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\FeaturedSection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function dashboard(){
        $counties = County::withCount('activeProperties')->get();;
        $featured_section = FeaturedSection::first();
        $featured_properties = Property::where('is_featured', 1)->where('status', '1')->latest()->limit(6)->get();
        $blogs = Blog::latest()->limit(3)->get();
        return view('frontend.index', compact('counties', 'featured_section', 'featured_properties', 'blogs'));
    }
    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with(['message' => 'You have been logged out.', 'type' => 'success']);
    }

    public function profile(){
        return view('frontend.profile');
    }

    public function profileUpdate(Request $request){
        $user = Auth::guard('web')->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if($request->profile_picture) {
            $request->validate([
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg',
            ]);
            $image = $request->file('profile_picture');
            $imageName = time().'_'.rand(11111,99999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/profile_images');
            $image->move($destinationPath, $imageName);
            if($user->photo && file_exists(public_path('/uploads/profile_images/'.$user->photo))) {
                unlink(public_path('/uploads/profile_images/'.$user->photo));
            }
            $user->photo = $imageName;
        }
        $user->update();
        return redirect()->route('user.profile')->with(['message' => 'Profile updated successfully.', 'type' => 'success']);
    }


    public function changePasswordUpdate(Request $request){

        $validate = Validator::make($request->all(), [
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        if($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $user = Auth::guard('web')->user();
        if(!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with(['message' => 'Current password does not match.', 'type' => 'danger']);
        }
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect()->route('user.profile')->with(['message' => 'Password updated successfully.', 'type' => 'success']);
    }
}
