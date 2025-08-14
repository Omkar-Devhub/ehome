<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCategoriesController extends Controller
{
    public function index(Request $request){
        $categories = BlogCategory::latest();
        // Searching
        if(!empty($request->get('keyword'))){
            $categories = $categories->where('name','like','%'.$request->get('keyword').'%');
        }
        $categories = $categories->paginate(10);
        return view('backend.admin.blog_category.index', compact('categories'));
    }

    public function create(){
        return view('backend.admin.blog_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        $category = BlogCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('admin.blog-categories')->withInput()->with('toast', ['message' => 'Category created successfully', 'type' => 'success']);
    }

    public function edit($category_id, Request $request)
    {
        $category = BlogCategory::findOrFail($category_id);
        return view('backend.admin.blog_category.edit', compact('category'));
    }

    public function update($category_id, Request $request)
    {
        $category = BlogCategory::findOrFail($category_id);
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,'.$category->id,
        ]);
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);
        return redirect()->route('admin.blog-categories')->withInput()->with('toast', ['message' => 'Category updated successfully', 'type' => 'success']);
    }

    public function delete($category_id, Request $request)
    {
        $category = BlogCategory::findOrFail($category_id);
        $category->delete();
        return redirect()->route('admin.blog-categories')->withInput()->with('toast', ['message' => 'Category deleted successfully', 'type' => 'success']);
    }
}
