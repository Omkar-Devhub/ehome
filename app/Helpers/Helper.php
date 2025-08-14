<?php

use App\Models\AdType;
use App\Models\Category;
use App\Models\ContactSetting;
use App\Models\HeroSection;
use App\Models\PropertyType;
use App\Models\GeneralSetting;
use App\Models\Page;
use App\Models\Property;
use App\Models\User;
use App\Models\VendorRequest;

function getCategories()
{
    return Category::where('status', '1')->Where('display', '1')->with('subcategories')->get();
}

function getHeroSection()
{
    return HeroSection::where('status', '1')->first();
}

function getNavbarMenu()
{
    return AdType::where('show_in_navbar', 1)->orderBy('orders', 'asc')
        ->with(['propertyTypes' => function ($query) {
            $query->where('show_in_navbar', 1);
        }])
        ->get();
}

function getPropertyTypesByAdType($adTypeId)
{
    return PropertyType::whereHas('adTypes', function ($query) use ($adTypeId) {
        $query->where('ad_type_id', $adTypeId);
    })
        ->where('show_in_navbar', 1)
        ->get();
}

function getActiveUsersCount()
{
    return User::where('status', '1')->count();
}

function getActivePropertiesCount()
{
    return Property::where('status', '1')->count();
}

function getPendingPropertiesCount()
{
    return Property::where('status', '0')->count();
}

function getRegistraionRequestCount()
{
    return VendorRequest::all()->count();
}

function getContactInfo()
{
    return ContactSetting::first();
}
function legalPages()
{
    $pages = Page::where('menu_name', 'legal')->orderBy('title', 'asc')->get();
    return $pages;
}
function companyPages()
{
    $pages = Page::where('menu_name', 'eirehome')->orderBy('title', 'asc')->get();
    return $pages;
}
