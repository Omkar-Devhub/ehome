<?php

namespace App\Http\Controllers\User;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    public function selectAdsType(){
        return view('frontend.select_ads_type');
    }

    public function myProperty(){
        $properties = Property::with('propertyable')->latest()->where('propertyable_id', Auth::guard('web')->id())->paginate(10);
        return view('frontend.my_property',compact('properties'));
    }
}
