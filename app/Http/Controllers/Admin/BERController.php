<?php

namespace App\Http\Controllers\Admin;

use App\Models\BER;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BERController extends Controller
{
    public function index(Request $request)
    {
        $bers = BER::orderBy('title', 'ASC');
        // search
        if (!empty($request->get('keyword'))) {
            $bers = $bers->where('title', 'like', '%' . $request->get('keyword'). '%');
        }
        $bers = $bers->paginate(10);
        return view('backend.admin.ber.index', compact('bers'));
    }

    public function create()
    {
        return view('backend.admin.ber.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'status' => 'nullable',
        ]);
        $ber = new BER();

        $imageName = "icon_".time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads/ber'), $imageName);
        $ber->icon = $imageName;

        $ber->title = $request->title;
        $ber->status =  $request->has('status') ? '1' : '0';
        $ber->save();
        return redirect()->route('admin.ber')->withInput()->with('toast', ['message' => 'BER created successfully', 'type' => 'success']);
    }

    public function edit($ber_id)
    {
        $ber = BER::findOrFail($ber_id);
        return view('backend.admin.ber.edit', compact('ber'));
    }

    public function update(Request $request, $ber_id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'nullable',
        ]);
        $ber = BER::findOrFail($ber_id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:1024',
            ]);
            $imageName = "icon_".time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/ber'), $imageName);
            if (file_exists(public_path('uploads/ber/' . $ber->icon))) {
                unlink(public_path('uploads/ber/' . $ber->icon));
            }
            $ber->icon = $imageName;
        }
        $ber->title = $request->title;
        $ber->status =  $request->has('status') ? '1' : '0';
        $ber->save();
        return redirect()->route('admin.ber')->withInput()->with('toast', ['message' => 'BER updated successfully', 'type' => 'success']);
    }

    public function delete($ber_id)
    {
        $ber = BER::findOrFail($ber_id);
        if (file_exists(public_path('uploads/ber/' . $ber->icon))) {
            unlink(public_path('uploads/ber/' . $ber->icon));
        }
        $ber->delete();
        return redirect()->route('admin.ber')->with('toast', ['message' => 'BER deleted successfully', 'type' => 'success']);
    }
}
