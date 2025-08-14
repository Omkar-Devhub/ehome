<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\VendorRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\VendorRegistrationRequestMail;

class ExtraController extends Controller
{
    public function fetchArea($county_id = null)
    {
        $area = Area::where('county_id', $county_id)->where('status', '1')->get();
        return response()->json([
            'status' => 1,
            'area' => $area
        ]);
    }

    public function getCoordinates(Request $request)
    {
        $eircode = $request->query('eircode');

        if (!$eircode || strlen($eircode) < 6) {
            return response()->json(['status' => 'error', 'message' => 'Invalid Eircode format'], 400);
        }

        $apiKey = config('services.google_maps.api_key'); // Best practice: store in config/services.php
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($eircode) . "&key=" . $apiKey;

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['status' => 'error', 'message' => 'Failed to connect to Google Maps API'], 500);
        }

        $json = $response->json();

        if (isset($json['status']) && $json['status'] === 'OK') {
            return response()->json([
                'lat' => $json['results'][0]['geometry']['location']['lat'],
                'lng' => $json['results'][0]['geometry']['location']['lng'],
                'status' => 'success',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => $json['error_message'] ?? 'Invalid Eircode or no results found'
        ], 400);
    }
}
