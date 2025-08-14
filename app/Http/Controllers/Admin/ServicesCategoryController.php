<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServicesCategory;
use App\Http\Controllers\Controller;

class ServicesCategoryController extends Controller
{
    public function index(Request $request)
    {
        $services_categories = ServicesCategory::latest();
        if (!empty($request->get('keyword'))) {
            $services_categories = $services_categories->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $services_categories = $services_categories->paginate(10);
        return view('backend.admin.services_category.index', compact('services_categories'));
    }

    public function create()
    {
        return view('backend.admin.services_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $services_category = new ServicesCategory();
        $services_category->name = $request->name;
        $services_category->save();
        return redirect()->route('admin.services-category')->with('toast', ['message' => 'Services Category created successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $services_category = ServicesCategory::find($id);
        return view('backend.admin.services_category.edit', compact('services_category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $services_category = ServicesCategory::find($id);
        $services_category->name = $request->name;
        $services_category->save();
        return redirect()->route('admin.services-category')->with('toast', ['message' => 'Services Category updated successfully', 'type' => 'success']);
    }

    public function delete($id)
    {
        $services_category = ServicesCategory::find($id);
        $services_category->delete();
        return redirect()->route('admin.services-category')->with('toast', ['message' => 'Services Category deleted successfully', 'type' => 'success']);
    }
}
