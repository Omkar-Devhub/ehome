<?php

namespace Database\Seeders;

use App\Models\Cookies;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CookiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cookies = new Cookies;
        $cookies->button_text = 'Accept';
        $cookies->alert_message = 'We use cookies to give you the best online experience. By continuing to browse the site you are agreeing to our use of cookies.';
        $cookies->status = 1;
        $cookies->save();
    }
}
