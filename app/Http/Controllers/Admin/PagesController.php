<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::latest();
        // Searching
        if (!empty($request->get('keyword'))) {
            $pages = $pages->where('title', 'like', '%' . $request->get('keyword') . '%');
        }
        $pages = $pages->paginate(10);
        return view('backend.admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('backend.admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'status' => 'nullable',
        ]);

        $page = Page::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'menu_name' => $request->menu_name,
            'created_at' => Carbon::now(),
            'status' => $request->has('status') ? '1' : '0',
        ]);

        return redirect()->route('admin.pages')->withInput()->with('toast', ['message' => 'Page created successfully', 'type' => 'success']);
    }

    public function edit($page_id, Request $request)
    {
        $page = Page::findOrFail($page_id);
        return view('backend.admin.pages.edit', compact('page'));
    }

    public function update($page_id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'nullable|string|max:255|unique:pages,slug,'.$page_id,
            'status' => 'nullable',
        ]);

        $page = Page::findOrFail($page_id);
        if(empty($page)){
            return redirect()->route('admin.pages')->with('toast', ['message' => 'Page not found', 'type' => 'error']);
        }
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->status = $request->has('status') ? '1' : '0';
        $page->updated_at = Carbon::now();
        $page->update();

        return redirect()->route('admin.pages')->withInput()->with('toast', ['message' => 'Page updated successfully', 'type' => 'success']);
    }

    public function delete($page_id, Request $request)
    {
        Page::findOrFail($page_id)->delete();
        return redirect()->route('admin.pages')->with('toast', ['message' => 'Page deleted successfully', 'type' => 'success']);
    }
}
