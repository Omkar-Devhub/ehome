<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PropertyCategory;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $property_categories = PropertyCategory::latest();
        //Searching
        if(!empty($request->get('keyword'))){
            $property_categories = $property_categories->where('name','like','%'.$request->get('keyword').'%');

        }
        $property_categories = $property_categories->paginate(10);
        return view('backend.admin.category.index', compact('property_categories'));
    }

    public function create()
    {
        return view('backend.admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = PropertyCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->withInput()->with('toast', ['message' => 'Category created successfully', 'type' => 'success']);
    }

    public function edit($category_id, Request $request)
    {
        $category = PropertyCategory::findOrFail($category_id);
        return view('backend.admin.category.edit', compact('category'));
    }

    public function update($category_id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = PropertyCategory::findOrFail($category_id);
        if(empty($category)){
            return redirect()->route('admin.category')->with('toast', ['message' => 'Category not found', 'type' => 'error']);
        }
        $category->name = $request->name;
        $category->updated_at = Carbon::now();
        $category->update();

        return redirect()->route('admin.category')->withInput()->with('toast', ['message' => 'Category updated successfully', 'type' => 'success']);
    }

    public function delete($category_id, Request $request)
    {
        PropertyCategory::findOrFail($category_id)->delete();
        return redirect()->route('admin.category')->with('toast', ['message' => 'Category deleted successfully', 'type' => 'success']);
    }
}
