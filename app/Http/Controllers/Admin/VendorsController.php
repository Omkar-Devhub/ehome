<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\County;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorsController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Vendor::latest();
        // Searching
        if (!empty($request->get('keyword'))) {
            $vendors = $vendors->where('name', 'like', '%' . $request->get('keyword') . '%')->orWhere('email', 'like', '%' . $request->get('keyword') . '%')->orWhere('phone', 'like', '%' . $request->get('keyword') . '%');
        }
        $vendors = $vendors->paginate(10);
        return view('backend.admin.vendors.index', compact('vendors'));
    }

    public function edit($vendor_id, Request $request)
    {
        $vendor = Vendor::findOrFail($vendor_id);
        $counties = County::all();
        return view('backend.admin.vendors.edit', compact('vendor', 'counties'));
    }

    public function update($vendor_id, Request $request)
    {

        $request->validate([
            'company_name' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $vendor = Vendor::findOrFail($vendor_id);

        $vendor->company_name = $request->company_name;
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->description = $request->description;
        $vendor->status = $request->status;
        $vendor->updated_at = Carbon::now();
        $vendor->update();
        return redirect()->route('admin.vendors')->withInput()->with('toast', ['message' => 'User updated successfully', 'type' => 'success']);
    }

    public function delete($vendor_id)
    {
        // $property_count = Property::where('propertyable_id', $user_id)->count();
        // if ($property_count > 0) {
        //     return redirect()->route('admin.users')->with('toast', ['message' => 'User has properties and cannot be deleted', 'type' => 'warning']);
        // }
        Vendor::findOrFail($vendor_id)->delete();
        return redirect()->route('admin.vendors')->with('toast', ['message' => 'User deleted successfully', 'type' => 'success']);
    }
}
