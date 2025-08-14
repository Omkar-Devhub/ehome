<?php

namespace App\Http\Controllers\Admin;

use App\Models\Robot;
use App\Models\Cookies;
use App\Models\Timezone;
use App\Models\SeoSetting;
use App\Models\AreaSection;
use App\Models\HeroSection;
use App\Models\EmailSetting;
use Illuminate\Http\Request;
use App\Models\ContactSetting;
use App\Models\GeneralSetting;
use App\Models\FeaturedSection;
use App\Models\MaintenanceMode;
use App\Http\Controllers\Controller;

class FrontEndController extends Controller
{
    public function heroSectionEdit()
    {
        $hero_section = HeroSection::first();
        return view('backend.admin.settings.homepage.hero_section.edit', compact('hero_section'));
    }

    public function HeroSectionUpdate(Request $request)
    {
        $hero_section = HeroSection::first();

        $request->validate([
            'title' => 'required',
            'subtitle' => 'required',
        ]);

        if ($request->hero_image) {
            $request->validate([
                'hero_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $imageName = "hero_image_" . time() . '.' . $request->hero_image->getClientOriginalExtension();
            $request->hero_image->move(public_path('uploads/frontend_images'), $imageName);
            if ($hero_section->image && file_exists(public_path('uploads/frontend_images/' . $hero_section->image))) {
                unlink(public_path('uploads/frontend_images/' . $hero_section->image));
            }
            $hero_section->image = $imageName;
        }

        $hero_section->title = $request->title;
        $hero_section->subtitle = $request->subtitle;
        $hero_section->update();
        return redirect()->back()->with('toast', ['message' => 'Hero section updated successfully', 'type' => 'success']);
    }

    public function featurePropertySectionEdit()
    {
        $featured = FeaturedSection::first();
        return view('backend.admin.settings.homepage.feature_property_section.edit', compact('featured'));
    }

    public function FeaturePropertySectionUpdate(Request $request)
    {
        $featured = FeaturedSection::first();
        $request->validate([
            'title' => 'required',
            'heading' => 'required',
            'btn_text' => 'required',
            'btn_link' => 'required',
            'status' => 'nullable'
        ]);
        $featured->title = $request->title;
        $featured->heading = $request->heading;
        $featured->button_text = $request->btn_text;
        $featured->button_link = $request->btn_link;
        $featured->status = $request->has('status') ? '1' : '0';
        $featured->update();
        return redirect()->back()->with('toast', ['message' => 'Feature property section updated successfully', 'type' => 'success']);
    }

    public function areaSectionEdit()
    {
        $area_section = AreaSection::first();
        return view('backend.admin.settings.homepage.area_section.edit', compact('area_section'));
    }

    public function AreaSectionUpdate(Request $request)
    {
        $area_section = AreaSection::first();
        $request->validate([
            'title' => 'required',
            'heading' => 'required',
            'status' => 'nullable'
        ]);
        $area_section->title = $request->title;
        $area_section->heading = $request->heading;
        $area_section->status = $request->has('status') ? '1' : '0';
        $area_section->update();

        return redirect()->back()->with('toast', ['message' => 'Area section updated successfully', 'type' => 'success']);
    }

    public function cookiesSectionEdit()
    {
        $cookies_section = Cookies::first();
        return view('backend.admin.settings.homepage.cookies_section.edit', compact('cookies_section'));
    }

    public function CookiesSectionUpdate(Request $request)
    {
        $cookies_section = Cookies::first();
        $request->validate([
            'button_text' => 'required',
            'message' => 'required',
            'status' => 'nullable'
        ]);
        $cookies_section->alert_message = $request->message;
        $cookies_section->button_text = $request->button_text;
        $cookies_section->status = $request->has('status') ? '1' : '0';
        $cookies_section->update();
        return redirect()->back()->with('toast', ['message' => 'Cookies setting updated successfully', 'type' => 'success']);
    }

    public function seoSectionEdit()
    {
        $seo_setting = SeoSetting::first();
        $robot = Robot::first() ?? new Robot(['content' => "User-agent: *\nDisallow: /admin"]);
        return view('backend.admin.settings.homepage.seo_section.edit', compact('seo_setting', 'robot'));
    }

    public function SeoSectionUpdate(Request $request)
    {
        $seo_setting = SeoSetting::first();
        $request->validate([
            'keywords' => 'required',
            'description' => 'required',
        ]);
        $seo_setting->keywords = $request->keywords;
        $seo_setting->description = $request->description;
        $seo_setting->update();
        return redirect()->back()->with('toast', ['message' => 'Seo setting updated successfully', 'type' => 'success']);
    }

    public function maintenanceSectionEdit()
    {
        $maintenance = MaintenanceMode::first();
        return view('backend.admin.settings.homepage.maintenance_section.edit', compact('maintenance'));
    }

    public function MaintenanceSectionUpdate(Request $request)
    {
        $maintenance = MaintenanceMode::first();
        $request->validate([
            'message' => 'required',
            'status' => 'nullable',
        ]);
        $maintenance->message = $request->message;
        $maintenance->status = $request->has('status') ? '1' : '0';
        $maintenance->update();
        return redirect()->back()->with('toast', ['message' => 'Maintenance mode updated successfully', 'type' => 'success']);
    }

    // General Section
    public function generalSectionEdit()
    {
        $general_settings = GeneralSetting::first();
        $timezones = Timezone::Orderby('offset')->get();
        return view('backend.admin.settings.homepage.general_section.edit', compact('general_settings', 'timezones'));
    }

    public function GeneralSectionUpdate(Request $request)
    {
        $general_settings = GeneralSetting::first();
        $request->validate([
            'website_title' => 'required',
            'copyright_text' => 'required',
            'language' => 'required',
            'timezone' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required',
            'back_to_top' => 'nullable',
        ]);

        if ($request->logo) {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $imageName = "logo_" . time() . '.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads/frontend_images'), $imageName);
            if ($general_settings->logo && file_exists(public_path('uploads/frontend_images/' . $general_settings->logo))) {
                unlink(public_path('uploads/frontend_images/' . $general_settings->logo));
            }
            $general_settings->logo = $imageName;
        }

        if ($request->favicon) {
            $request->validate([
                'favicon' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            $imageName = "favicon_" . time() . '.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads/frontend_images'), $imageName);
            if ($general_settings->favicon && file_exists(public_path('uploads/frontend_images/' . $general_settings->favicon))) {
                unlink(public_path('uploads/frontend_images/' . $general_settings->favicon));
            }
            $general_settings->favicon = $imageName;
        }

        $general_settings->webiste_title = $request->website_title;
        $general_settings->copyright_text = $request->copyright_text;
        $general_settings->language = $request->language;
        $general_settings->timezone = $request->timezone;
        $general_settings->currency = $request->currency;
        $general_settings->currency_symbol = $request->currency_symbol;
        $general_settings->back_to_top = $request->has('back_to_top') ? '1' : '0';
        $general_settings->update();
        return redirect()->back()->with('toast', ['message' => 'General section updated successfully', 'type' => 'success']);
    }

    public function emailSettingsEdit()
    {
        $email_settings = EmailSetting::first();
        return view('backend.admin.settings.homepage.email_settings.edit', compact('email_settings'));
    }

    public function EmailSettingsUpdate(Request $request)
    {
        $email_settings = EmailSetting::first();
        $request->validate([
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'encryption' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'from_email' => 'required',
            'from_name' => 'required',
            'status' => 'nullable',
        ]);
        $email_settings->smtp_host = $request->smtp_host;
        $email_settings->smtp_port = $request->smtp_port;
        $email_settings->encryption = $request->encryption;
        $email_settings->smtp_username = $request->smtp_username;
        $email_settings->smtp_password = $request->smtp_password;
        $email_settings->from_email = $request->from_email;
        $email_settings->from_name = $request->from_name;
        $email_settings->status = $request->has('status') ? '1' : '0';
        $email_settings->update();
        return redirect()->back()->with('toast', ['message' => 'Email settings updated successfully', 'type' => 'success']);
    }

    public function contactSettingsEdit()
    {
        $contact_settings = ContactSetting::first();
        return view('backend.admin.settings.homepage.contact_settings.edit', compact('contact_settings'));
    }

    public function ContactSettingsUpdate(Request $request)
    {
        $contact_settings = ContactSetting::first();
        $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'approver_email' => 'required',
            'sales_email' => 'required',
        ]);
        $contact_settings->address = $request->address;
        $contact_settings->phone = $request->phone;
        $contact_settings->email = $request->email;
        $contact_settings->approver_email = $request->approver_email;
        $contact_settings->sales_email = $request->sales_email;
        $contact_settings->update();
        return redirect()->back()->with('toast', ['message' => 'Contact settings updated successfully', 'type' => 'success']);
    }
}
