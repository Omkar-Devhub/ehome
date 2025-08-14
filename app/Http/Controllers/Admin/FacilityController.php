<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        $facilities = Facility::latest();

        // Searching
        if(!empty($request->get('keyword'))){
            $facilities = $facilities->where('name','like','%'.$request->get('keyword').'%');
        }
        $facilities = $facilities->paginate(10);

        return view('backend.admin.facility.index', compact('facilities'));
    }

    public function create()
    {
        return view('backend.admin.facility.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'nullable',
        ]);

        Facility::create([
            'name' => $request->name,
            'status' => $request->has('status') ? '1' : '0'
        ]);

        return redirect()->route('admin.facility')->with('toast', ['message' => 'Facility created successfully', 'type' => 'success']);
    }

    public function edit($facility_id,Request $request)
    {
        $facility = Facility::findOrFail($facility_id);
        return view('backend.admin.facility.edit', compact('facility'));
    }

    public function update($facility_id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'nullable',
        ]);

        $facility = Facility::findOrFail($facility_id);
        $facility->update([
            'name' => $request->name,
            'status' => $request->has('status') ? '1' : '0'
        ]);

        return redirect()->route('admin.facility')->with('toast', ['message' => 'Facility updated successfully', 'type' => 'success']);
    }

    public function delete($facility_id, Request $request)
    {
        Facility::findOrFail($facility_id)->delete();
        return redirect()->route('admin.facility')->with('toast', ['message' => 'Facility deleted successfully', 'type' => 'success']);
    }
}
