<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::latest();
        // Searching
        if(!empty($request->get('keyword'))){
            $users = $users->where('name','like','%'.$request->get('keyword').'%')->orWhere('email','like','%'.$request->get('keyword').'%')->orWhere('phone','like','%'.$request->get('keyword').'%');
        }
        $users = $users->paginate(10);
        return view('backend.admin.users.index', compact('users'));
    }

    public function edit($user_id, Request $request){
        $user = User::findOrFail($user_id);
        return view('backend.admin.users.edit', compact('user'));
    }

    public function update($user_id, Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);

        $user = User::findOrFail($user_id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status;
        $user->updated_at = Carbon::now();
        $user->update();
        return redirect()->route('admin.users')->withInput()->with('toast', ['message' => 'User updated successfully', 'type' => 'success']);
    }

    public function delete($user_id)
    {
        $property_count = Property::where('propertyable_id', $user_id)->count();
        if($property_count > 0){
            return redirect()->route('admin.users')->with('toast', ['message' => 'User has properties and cannot be deleted', 'type' => 'warning']);
        }
        User::findOrFail($user_id)->delete();
        return redirect()->route('admin.users')->with('toast', ['message' => 'User deleted successfully', 'type' => 'success']);
    }
}
