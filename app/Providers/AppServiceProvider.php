<?php

namespace App\Providers;

use App\Models\EmailSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        if (Schema::hasTable('email_settings') && Schema::hasColumn('email_settings', 'status')) {
            $email_settings = EmailSetting::first();
            if ($email_settings && $email_settings->status == 1) {
                Config::set('mail', [
                    'driver' => 'smtp',
                    'host' => $email_settings->smtp_host,
                    'port' => $email_settings->smtp_port,
                    'username' => $email_settings->smtp_username,
                    'password' => $email_settings->smtp_password,
                    'encryption' => $email_settings->encryption,
                    'from' => [
                        'address' => $email_settings->from_email,
                        'name' => $email_settings->from_name,
                    ],
                ]);
            }
        }
    }
}
