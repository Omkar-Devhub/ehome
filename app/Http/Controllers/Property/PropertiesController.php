<?php

namespace App\Http\Controllers\Property;

use Exception;
use App\Models\AdType;
use App\Models\County;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Mail\PropertyInquiry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PropertiesController extends Controller
{
    public function showProperties(Request $request, $adTypeSlug, $propertyTypeSlug = null)
    {
        // Find Ad Type
        $adType = AdType::where('name', $adTypeSlug)->firstOrFail();

        // Fetch properties based on Ad Type and Property Type
        $query = Property::whereHas('adType', function ($q) use ($adType) {
            $q->where('ad_types.id', $adType->id);
        });

        if ($propertyTypeSlug) {
            $propertyType = PropertyType::where('name', $propertyTypeSlug)->firstOrFail();
            $query->where('property_type_id', $propertyType->id);
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('property_category_id', $request->category);
        }

        //     // Filter by county
        if ($request->has('county_id') && $request->county_id != '') {
            $query->where('county_id', $request->county_id);
        }

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

        // Filter by facilities
        // if ($request->has('facilities')) {
        //     $facilities = $request->facilities;
        //     $query->whereHas('facilities', function($q) use ($facilities) {
        //         $q->whereIn('facilities', $facilities);
        //     });
        // }

        $query->orderBy('created_at', 'DESC');
        $query->where('status', 1);

        $properties = $query->paginate(10);
        $counties = County::all();
        $propertyTypes = PropertyType::all();
        $facilities = Feature::all();
        return view('frontend.properties.index', compact('properties', 'adType', 'propertyTypeSlug', 'counties', 'propertyTypes', 'facilities'));
    }

    public function sendInquiries(Request $request, $property_id)
    {
        $message = nl2br($request->message);

        $property = Property::find($request->property_id);

        $user = auth()->user();

        $messageDetails = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'message' => $message,
            'date' => now(),
            'property_title' => ucfirst($property->county->name) . ', ' . ucfirst($property->area->name) . ', ' . ucfirst($property->address) . ', ' . $property->eircode,
            'property_type' => ucfirst($property->type->name),
            'owner_name' => $property->propertyable->name
        ];

        try {
            Mail::to($property->propertyable->email)->queue(new PropertyInquiry($messageDetails));
            return redirect()->back()->with('toast', ['message' => 'Message sent successfully', 'type' => 'success']);
        } catch (Exception $e) {
            return redirect()->back()->with('toast', ['message' => 'Message sent failed', 'type' => 'warning']);
        }
    }
}
