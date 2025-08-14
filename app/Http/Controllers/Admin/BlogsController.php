<?php

namespace App\Http\Controllers\Admin;

use DOMDocument;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogsController extends Controller
{
    public function index(){
        $blogs = Blog::latest()->paginate(10);
        return view('backend.admin.blogs.index',compact('blogs'));
    }

    public function create(){
        $categories = BlogCategory::all();
        return view('backend.admin.blogs.create',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'nullable',
        ]);

        $blog = new Blog();

        if($request->hasFile('featured_image')) {
            $request->validate([
                'featured_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ]);
            $image = $request->file('featured_image');
            $name = 'featured_image_'.time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/blogs');
            $image->move($destinationPath, $name);
            $blog->featured_image = $name;
        }

        $blog->title = $request->title;
        $blog->slug = $request->slug;

        $dom = new DOMDocument();
        $dom->loadHTML($request->content,9);

        $images = $dom->getElementsByTagName('img');
        foreach($images as $key => $image) {
            $data = base64_decode(explode(',',explode(';', $image->getAttribute('src'))[1])[1]);
            $image_name = "/uploads/blogs/blog_".time().$key.'.png';
            file_put_contents(public_path($image_name), $data);
            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $blog->content = $dom->saveHTML();

        $blog->category_id = $request->category_id;
        $blog->is_active = $request->has('status') ? '1' : '0';
        $blog->save();

        return redirect()->route('admin.blogs-posts')->with('toast', ['message' => 'Post created successfully', 'type' => 'success']);
    }

    public function edit($blog_id, Request $request){
        $categories = BlogCategory::all();
        $blog = Blog::findOrFail($blog_id);
        return view('backend.admin.blogs.edit',compact('blog','categories'));
    }

    public function update($blog_id, Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,'.$blog_id,
            'content' => 'required',
            'category_id' => 'required',
            'status' => 'nullable',
        ]);

        $blog = Blog::findOrFail($blog_id);

        if($request->hasFile('featured_image')) {
            $request->validate([
                'featured_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            ]);
            $image = $request->file('featured_image');
            $name = 'featured_image_'.time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/blogs');
            $image->move($destinationPath, $name);
            if($blog->featured_image && file_exists(public_path('/uploads/blogs/'.$blog->featured_image))) {
                unlink(public_path('/uploads/blogs/'.$blog->featured_image));
            }
            $blog->featured_image = $name;
        }

        $blog->title = $request->title;
        $blog->slug = $request->slug;

        $dom = new DOMDocument();
        $dom->loadHTML($request->content,9);

        $images = $dom->getElementsByTagName('img');
        foreach($images as $key => $image) {
            if(strpos($image->getAttribute('src'), 'data:image/') === 0) {
                $data = base64_decode(explode(',',explode(';', $image->getAttribute('src'))[1])[1]);
                $image_name = "/uploads/blogs/blog_".time().$key.'.png';
                file_put_contents(public_path($image_name), $data);
                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }
        }

        $blog->content = $dom->saveHTML();

        $blog->category_id = $request->category_id;
        $blog->is_active = $request->has('status') ? '1' : '0';
        $blog->save();

        return redirect()->route('admin.blogs-posts')->with('toast', ['message' => 'Post updated successfully', 'type' => 'success']);
    }

    public function delete($blog_id){
        $blog = Blog::findOrFail($blog_id);

        $dom = new DOMDocument();
        $dom->loadHTML($blog->content,9);

        $images = $dom->getElementsByTagName('img');
        foreach($images as $image) {
            if(file_exists(public_path($image->getAttribute('src')))) {
                unlink(public_path($image->getAttribute('src')));
            }
        }

        if($blog->featured_image && file_exists(public_path('/uploads/blogs/'.$blog->featured_image))) {
            unlink(public_path('/uploads/blogs/'.$blog->featured_image));
        }

        $blog->delete();
        return redirect()->route('admin.blogs-posts')->with('toast', ['message' => 'Post deleted successfully', 'type' => 'success']);
    }
}
