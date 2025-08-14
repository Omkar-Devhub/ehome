<?php

namespace App\Http\Controllers\Admin;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertyCategory;
use App\Http\Controllers\Controller;

class PropertyTypeController extends Controller
{
    public function index()
    {
        $property_types = PropertyType::latest();

        // Searching
        if(!empty(request()->get('keyword'))){
            $property_types = $property_types->where('name','like','%'.request()->get('keyword').'%');
        }
        $property_types = $property_types->paginate(10);
        return view('backend.admin.types.index', compact('property_types'));
    }

    public function create(){
        $property_categories = PropertyCategory::latest()->get();
        return view('backend.admin.types.create', compact('property_categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $property_type = PropertyType::create([
            'name' => $request->name,
            'property_category_id' => $request->category,
        ]);

        return redirect()->route('admin.property-types')->withInput()->with('toast', ['message' => 'Property Type created successfully', 'type' => 'success']);
    }

    public function edit($property_type_id, Request $request){
        $property_type = PropertyType::findOrFail($property_type_id);
        $property_categories = PropertyCategory::latest()->get();
        return view('backend.admin.types.edit', compact('property_type', 'property_categories'));
    }

    public function update($property_type_id, Request $request){
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $property_type = PropertyType::findOrFail($property_type_id);
        $property_type->name = $request->name;
        $property_type->property_category_id = $request->category;
        $property_type->save();

        return redirect()->route('admin.property-types')->withInput()->with('toast', ['message' => 'Property Type updated successfully', 'type' => 'success']);
    }

    public function delete($property_type_id){
        PropertyType::findOrFail($property_type_id)->delete();
        return redirect()->route('admin.property-types')->withInput()->with('toast', ['message' => 'Property Type deleted successfully', 'type' => 'success']);
    }
}
