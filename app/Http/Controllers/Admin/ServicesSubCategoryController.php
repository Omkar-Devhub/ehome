<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServicesCategory;
use App\Models\ServicesSubCategory;
use App\Http\Controllers\Controller;

class ServicesSubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $services_sub_categories = ServicesSubCategory::latest();
        if (!empty($request->get('keyword'))) {
            $services_sub_categories = $services_sub_categories->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $services_sub_categories = $services_sub_categories->paginate(10);

        return view('backend.admin.services_sub_category.index', compact('services_sub_categories'));
    }

    public function create()
    {
        $service_categories = ServicesCategory::latest()->get();
        return view('backend.admin.services_sub_category.create', compact('service_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'service_category_id' => 'required',
        ]);

        $services_sub_category = new ServicesSubCategory();
        $services_sub_category->name = $request->name;
        $services_sub_category->services_category_id = $request->service_category_id;
        $services_sub_category->save();

        return redirect()->route('admin.services-sub-category')->with('toast', ['message' => 'Services SubCategory created successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $services_sub_category = ServicesSubCategory::find($id);
        $service_categories = ServicesCategory::latest()->get();
        return view('backend.admin.services_sub_category.edit', compact('services_sub_category', 'service_categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'service_category_id' => 'required',
        ]);

        $services_sub_category = ServicesSubCategory::find($id);
        $services_sub_category->name = $request->name;
        $services_sub_category->services_category_id = $request->service_category_id;
        $services_sub_category->save();

        return redirect()->route('admin.services-sub-category')->with('toast', ['message' => 'Services SubCategory updated successfully', 'type' => 'success']);
    }

    public function delete($id)
    {
        $services_sub_category = ServicesSubCategory::find($id);
        $services_sub_category->delete();

        return redirect()->route('admin.services-sub-category')->with('toast', ['message' => 'Services SubCategory deleted successfully', 'type' => 'success']);
    }
}
