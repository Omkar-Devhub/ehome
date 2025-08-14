<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalSetting = new GeneralSetting;
        $generalSetting->webiste_title = 'Eirehome';
        $generalSetting->logo = 'logo.png';
        $generalSetting->favicon = 'favicon.png';
        $generalSetting->language = 'en';
        $generalSetting->currency = 'EUR';
        $generalSetting->currency_symbol = '€';
        $generalSetting->timezone = 'UTC';
        $generalSetting->copyright_text = 'Eirehome';
        $generalSetting->back_to_top = '1';
        $generalSetting->save();
    }
}
