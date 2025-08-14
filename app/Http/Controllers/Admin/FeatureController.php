<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $features = Feature::latest();
        // Searching
        if(!empty($request->get('keyword'))){
            $features = $features->where('name','like','%'.$request->get('keyword').'%');

        }
        $features = $features->paginate(10);
        return view('backend.admin.feature.index', compact('features'));
    }

    public function create()
    {
        return view('backend.admin.feature.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'nullable',
        ]);

        Feature::create([
            'name' => $request->name,
            'status' => $request->has('status') ? '1' : '0'
        ]);

        return redirect()->route('admin.features')->with('toast', ['message' => 'Feature created successfully', 'type' => 'success']);
    }

    public function edit($feature_id, Request $request)
    {
        $feature = Feature::findOrFail($feature_id);
        return view('backend.admin.feature.edit', compact('feature'));
    }

    public function update($feature_id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'nullable',
        ]);

        $feature = Feature::findOrFail($feature_id);
        $feature->update([
            'name' => $request->name,
            'status' => $request->has('status') ? '1' : '0'
        ]);

        return redirect()->route('admin.features')->with('toast', ['message' => 'Feature updated successfully', 'type' => 'success']);
    }

    public function delete($feature_id, Request $request)
    {
        Feature::findOrFail($feature_id)->delete();
        return redirect()->route('admin.features')->with('toast', ['message' => 'Feature deleted successfully', 'type' => 'success']);
    }
}
