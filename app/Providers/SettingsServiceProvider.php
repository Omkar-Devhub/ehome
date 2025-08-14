<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if(Schema::hasTable('general_settings')) {

            $general_settings = GeneralSetting::first();

            if($general_settings) {
                Config::set('settings', [
                    'website_title' => $general_settings->website_title,
                    'logo' => $general_settings->logo,
                    'favicon' => $general_settings->favicon,
                    'language' => $general_settings->language,
                    'timezone' => $general_settings->timezone,
                    'currency' => $general_settings->currency,
                    'currency_symbol' => $general_settings->currency_symbol,
                    'copyright_text' => $general_settings->copyright_text,
                    'back_to_top' => $general_settings->back_to_top
                ]);
            }

        }
    }
}
