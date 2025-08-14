<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\County;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::latest()->orderBy('name', 'ASC')->leftJoin('counties', 'areas.county_id', '=', 'counties.id')->select('areas.*', 'counties.name as county_name');
        // Searching
        if(!empty($request->get('keyword'))){
            $areas = $areas->where('areas.name', 'like', '%'.$request->get('keyword').'%');
            $areas = $areas->orwhere('counties.name', 'like', '%'.$request->get('keyword').'%');
        }
        $areas = $areas->paginate(50);
        return view('backend.admin.area.index', compact('areas'));
    }

    public function create()
    {
        $counties = County::where('status', '1')->orderBy('name', 'ASC')->get();
        return view('backend.admin.area.create', compact('counties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_file' => 'required|mimes:xlsx,csv,xls',
            'county_id' => 'required',
        ]);

        $data = Excel::toArray([], $request->file('area_file'))[0];
        foreach (array_slice($data, 1) as $row) {
            $areaName = strtolower(trim($row[0])); // Normalize case and trim spaces

            if (!Area::where('name', $areaName)->exists()) {
                Area::create([
                    'name'   => $areaName,
                    'county_id' => $request->county_id,
                    'status' => $row[1] ?? 1,
                ]);
            }
        }
        return redirect()->route('admin.areas')->with('toast', ['message' => 'Areas imported successfully', 'type' => 'success']);
    }

    public function edit($area_id, Request $request)
    {
        $area = Area::findOrFail($area_id);
        $counties = County::where('status', '1')->orderBy('name', 'ASC')->get();
        return view('backend.admin.area.edit', compact('area', 'counties'));
    }

    public function update($area_id, Request $request)
    {
        $area = Area::findOrFail($area_id);
        $area->update([
            'name'   => $request->name,
            'county_id' => $request->county_id,
            'status' => $request->has('status') ? '1' : '0',
        ]);
        return redirect()->route('admin.areas')->with('toast', ['message' => 'Area updated successfully', 'type' => 'success']);
    }

    public function delete($area_id, Request $request)
    {
        Area::findOrFail($area_id)->delete();
        return redirect()->route('admin.areas')->with('toast', ['message' => 'Area deleted successfully', 'type' => 'success']);
    }
}
