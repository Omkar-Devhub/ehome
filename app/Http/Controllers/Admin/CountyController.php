<?php

namespace App\Http\Controllers\Admin;

use App\Models\County;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class CountyController extends Controller
{
    public function index(Request $request){
        $counties = County::latest();
        // Searching
        if(!empty(request()->get('keyword'))){
            $counties = $counties->where('name','like','%'.request()->get('keyword').'%');
        }
        $counties = $counties->paginate(10);
        return view('backend.admin.county.index', compact('counties'));
    }

    public function create(){
        return view('backend.admin.county.create');
    }

    public function store(Request $request){
        $request->validate([
            'counties_file' => 'required|mimes:xlsx,csv,xls',
        ]);

        $data = Excel::toArray([], $request->file('counties_file'))[0];
        foreach (array_slice($data, 1) as $row) {
            $countyName = strtolower(trim($row[0])); // Normalize case and trim spaces

            if (!County::where('name', $countyName)->exists()) {
                County::create([
                    'name'   => $countyName,
                    'status' => $row[1] ?? 1,
                ]);
            }
        }
        return redirect()->route('admin.counties')->with('toast', ['message' => 'Counties imported successfully', 'type' => 'success']);
    }

    public function edit($county_id, Request $request){
        $county = County::findOrFail($county_id);
        return view('backend.admin.county.edit', compact('county'));
    }

    public function update($county_id, Request $request){
        $request->validate([
            'name' => 'required',
            'status' => 'nullable',
        ]);

        $county = County::findOrFail($county_id);
        $county->update([
            'name' => strtolower(trim($request->name)),
            'status' => $request->has('status') ? '1' : '0'
        ]);

        return redirect()->route('admin.counties')->with('toast', ['message' => 'County updated successfully', 'type' => 'success']);
    }

    public function delete($county_id, Request $request){
        County::findOrFail($county_id)->delete();
        return redirect()->route('admin.counties')->with('toast', ['message' => 'County deleted successfully', 'type' => 'success']);
    }
}
