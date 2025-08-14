<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seoSetting = new SeoSetting;
        $seoSetting->description = 'Eire Home';
        $seoSetting->keywords = 'Eire Home';
        $seoSetting->save();
    }
}
