<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Area;
use App\Models\Blog;
use App\Models\Page;
use App\Models\County;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\FeaturedSection;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $counties = County::withCount('activeProperties')->get();;
        $featured_section = FeaturedSection::first();
        $featured_properties = Property::where('is_featured', 1)->where('status', '1')->latest()->limit(6)->get();
        $blogs = Blog::latest()->limit(3)->get();
        return view('frontend.index', compact('counties', 'featured_section', 'featured_properties', 'blogs'));
    }

    public function login()
    {
        return view('frontend.login');
    }

    public function registration()
    {
        return view('frontend.register');
    }

    public function forgotPassword()
    {
        return view('frontend.forgot-password');
    }

    public function search(Request $request)
    {
        $query = Property::query();

        if ($request->filled('county_id')) {
            $query->where('county_id', $request->county_id);
        }

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->area_id);
        }

        if ($request->filled('ad_type_id')) {
            $query->where('ad_type_id', $request->ad_type_id);
        }

        // Filter by property type
        if ($request->has('property_type_id') && $request->property_type_id != '') {
            $query->where('property_type_id', $request->property_type_id);
        }

        // Filter by bedrooms
        if ($request->has('bed_rooms') && $request->bed_rooms != '') {
            $query->where('single_bedrooms', $request->bed_rooms);
        }

        // Filter by bathrooms
        if ($request->has('bath_rooms') && $request->bath_rooms != '') {
            $query->where('bath_rooms', $request->bath_rooms);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by furnished status
        if ($request->has('furnished') && $request->furnished != '') {
            $query->where('furnishing_status', $request->furnished);
        }

        $properties = $query->where('status', '1')->latest()->paginate(10);
        $propertyTypes = PropertyType::all();
        $facilities = Feature::all();
        return view('frontend.properties.search', compact('properties', 'propertyTypes', 'facilities'));
    }

    public function show($type, $slug)
    {
        $property = Property::where('slug', $slug)
            ->firstOrFail();
        if ($property == null) {
            abort(404);
        }
        Property::where('id', $property->id)->update(['views' => $property->views + 1]);
        $similarProperties = Property::where('property_type_id', $property->property_type_id)->where('id', '!=', $property->id)->where('status', '1')->latest()->limit(3)->get();
        return view('frontend.properties.details', compact('property', 'similarProperties'));
    }

    public function showCountyWiseProperties(Request $request, $county)
    {
        $county_id = County::where('name', $county)->first()->id;
        $query = Property::where('county_id', $county_id)->where('status', '1')->latest();
        $areas = Area::where('county_id', $county_id)->get();
        $propertyTypes = PropertyType::all();
        $facilities = Feature::all();

        // Filter by area
        if ($request->has('area_id') && $request->area_id != '') {
            $query->where('area_id', $request->area_id);
        }

        // Filter by property type
        if ($request->has('property_type_id') && $request->property_type_id != '') {
            $query->where('property_type_id', $request->property_type_id);
        }

        // Filter by bedrooms
        if ($request->has('bed_rooms') && $request->bed_rooms != '') {
            $query->where('single_bedrooms', $request->bed_rooms);
        }

        // Filter by bathrooms
        if ($request->has('bath_rooms') && $request->bath_rooms != '') {
            $query->where('bath_rooms', $request->bath_rooms);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by furnished status
        if ($request->has('furnished') && $request->furnished != '') {
            $query->where('furnishing_status', $request->furnished);
        }

        $properties = $query->paginate(10);

        return view('frontend.properties.common', compact('properties', 'county', 'areas', 'propertyTypes', 'facilities'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        if ($page == null) {
            abort(404);
        }
        return view('frontend.details_page', compact('page'));
    }
}
