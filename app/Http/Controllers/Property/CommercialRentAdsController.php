<?php

namespace App\Http\Controllers\Property;

use Carbon\Carbon;
use App\Models\BER;
use App\Models\County;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertyImage;
use App\Mail\PropertySubmittedMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CommercialRentAdsController extends Controller
{
    public function commercialRentAds()
    {
        $counties = County::where('status', '1')->get();
        $bers = BER::where('status', '1')->orderBy('id', 'ASC')->get();
        $facilities = Feature::where('status', '1')->orderBy('id', 'ASC')->get();
        $property_types = PropertyType::where('property_category_id', '2')->latest()->get();
        return view('frontend.ads.commercial_rent', compact('counties', 'bers', 'facilities', 'property_types'));
    }

    public function commercialRentAdsStore(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'county_id' => 'required',
            'area_id' => 'required',
            'eircode' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'slug' => 'required|unique:properties,slug',
            'price' => 'required',
            'rent_type' => 'required',
            'property_type' => 'required',
            'available_from' => 'nullable',
            'lease' => 'nullable',
            'ber' => 'nullable',
            'ber_no' => 'nullable',
            'property_size' => 'nullable',
            'units' => 'nullable',
            'description' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        // Determine the polymorphic relationship type and ID
        if (Auth::guard('web')->check()) {
            $propertyableId = Auth::guard('web')->id();
            $propertyableType = 'App\Models\User'; // Fully qualified class name
        } elseif (Auth::guard('agent')->check()) {
            $propertyableId = Auth::guard('agent')->id();
            $propertyableType = 'App\Models\Agent'; // Fully qualified class name
        } else {
            return redirect()->back()->with('error', 'Unauthorized.');
        }

        $property_id = Property::insertGetId([
            'county_id' => $request->county_id,
            'area_id' => $request->area_id,
            'eircode' => $request->eircode,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'slug' => $request->slug,
            'price' => $request->price,
            'rent_type' => $request->rent_type,
            'available_from' => $request->available_from,
            'lease' => $request->lease,
            'ber_id' => $request->ber,
            'ber_no' => $request->ber_no,
            'property_size' => $request->property_size,
            'units' => $request->units,
            'description' => $request->description,
            'views' => '0',
            'is_featured' => '0',
            'ad_type_id' => '1',
            'property_category_id' => "2",
            'property_type_id' =>  $request->property_type,
            'propertyable_id' => $propertyableId,
            'propertyable_type' => $propertyableType,
            'phone_number_visiblity' => $request->has('show_ph') ? '1' : '0',
            'created_at' => Carbon::now(),
        ]);

        $uploadedImages = json_decode($request->input('uploaded_images'), true);
        if ($uploadedImages) {
            foreach ($uploadedImages as $tempPath) {
                $filename = basename($tempPath);
                $finalPath = 'uploads/property_images/' . $filename;

                // Move the file from temp to property_images
                if (File::exists(public_path($tempPath))) {
                    File::move(public_path($tempPath), public_path($finalPath));
                }

                PropertyImage::create([
                    'image' => $finalPath,
                    'property_id' => $property_id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }

        $approverEmail = getContactInfo()->approver_email;
        $property_details = Property::find($property_id);
        // Send email to approver
        Mail::to($approverEmail)->queue(new PropertySubmittedMail($property_details));
        return redirect()->route('user.my.property')->with('toast', ['message' => 'Property submitted successfully', 'type' => 'success']);
    }

    public function uploadImages(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = time() . '_' . rand(11111, 99999) . '_' . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('temp'), $filename);
            return response()->json(['file_path' => 'temp/' . $filename]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
