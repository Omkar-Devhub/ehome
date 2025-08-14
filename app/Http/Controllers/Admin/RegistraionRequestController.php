<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VendorRequest;
use Illuminate\Http\Request;

class RegistraionRequestController extends Controller
{
    public function index(Request $request)
    {
        $registration_requests = VendorRequest::latest();

        if (!empty($request->get('keyword'))) {
            $registration_requests = $registration_requests->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $registration_requests = $registration_requests->paginate(10);

        return view('backend.admin.reg_request.index', compact('registration_requests'));
    }

    public function delete($request_id, Request $request)
    {
        VendorRequest::findOrFail($request_id)->delete();
        return redirect()->route('admin.registration-requests')->with('toast', ['message' => 'Request deleted successfully', 'type' => 'success']);
    }
}
