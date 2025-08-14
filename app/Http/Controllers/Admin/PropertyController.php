<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UpdateMail;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index()
    {
        $porperties = Property::with('propertyable')->where('status', '!=', '2')->latest()->paginate(10);
        return view('backend.admin.property.index', compact('porperties'));
    }

    public function edit($property_id, Request $request)
    {
        $property = Property::with('propertyable')->where('id', $property_id)->first();
        return view('backend.admin.property.edit', compact('property'));
    }

    public function preview($property_id, Request $request)
    {
        $property = Property::with('propertyable')->where('id', $property_id)->first();
        return view('backend.admin.property.preview', compact('property'));
    }

    public function inReview()
    {
        $porperties = Property::with('propertyable')->latest()->where('status', '0')->paginate(10);
        return view('backend.admin.property.index', compact('porperties'));
    }

    public function disapproved()
    {
        $porperties = Property::with('propertyable')->latest()->where('status', '2')->paginate(10);
        return view('backend.admin.property.index', compact('porperties'));
    }

    public function statusUpdate($property_id, Request $request)
    {
        $property = Property::where('id', $property_id)->first();
        $property->status = $request->status;
        if ($request->status == 2) {
            $property->comments = $request->reason;
        }
        $property->save();
        $details = [
            'title' =>  ucfirst($property->address) . ', ' . ucfirst($property->area->name) . ', ' . ucfirst($property->county->name) . ', ' . $property->eircode,
            'name' => $property->propertyable->name,
            'email' => $property->propertyable->email,
            'status' => $property->status == 1 ? 'Approved' : 'Rejected',
            'reason' => $property->comments ?? ''
        ];

        Mail::to($property->propertyable->email)->queue(new UpdateMail($details));
        return redirect()->route('admin.properties')->with('toast', ['message' => 'Property status updated successfully', 'type' => 'success']);
    }
}
