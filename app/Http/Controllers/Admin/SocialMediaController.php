<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SocialMediaSection;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
    public function index()
    {
        $social_media = SocialMediaSection::latest()->paginate(10);
        return view('backend.admin.social_media.index', compact('social_media'));
    }

    public function create()
    {
        return view('backend.admin.social_media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'status' => 'nullable',
        ]);

        $social_media = new SocialMediaSection();
        $social_media->icon = $request->icon;
        $social_media->url = $request->url;
        $social_media->status = $request->has('status') ? '1' : '0';
        $social_media->save();

        return redirect()->route('admin.settings.social-media')->withInput()->with('toast', ['message' => 'Social Media created successfully', 'type' => 'success']);
    }

    public function edit($social_media_id, Request $request)
    {
        $social_media = SocialMediaSection::findOrFail($social_media_id);
        return view('backend.admin.social_media.edit', compact('social_media'));
    }

    public function update($social_media_id, Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'status' => 'nullable',
        ]);

        $social_media = SocialMediaSection::findOrFail($social_media_id);
        $social_media->icon = $request->icon;
        $social_media->url = $request->url;
        $social_media->status = $request->has('status') ? '1' : '0';
        $social_media->updated_at = Carbon::now();
        $social_media->update();

        return redirect()->route('admin.settings.social-media')->withInput()->with('toast', ['message' => 'Social Media updated successfully', 'type' => 'success']);
    }

    public function delete($social_media_id, Request $request)
    {
        SocialMediaSection::findOrFail($social_media_id)->delete();
        return redirect()->route('admin.settings.social-media')->withInput()->with('toast', ['message' => 'Social Media deleted successfully', 'type' => 'success']);
    }
}
