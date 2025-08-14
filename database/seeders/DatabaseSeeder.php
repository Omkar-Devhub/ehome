<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminDataSeeder::class);
        $this->call(HeroSectionSeeder::class);
        $this->call(FeaturedSectionSeeder::class);
        $this->call(AreaSectionSeeder::class);
        $this->call(CookiesSeeder::class);
        $this->call(SeoSettingSeeder::class);
        $this->call(MaintenanceModeSeeder::class);
        $this->call(GeneralSettingSeeder::class);
        $this->call(TimezoneTableSeeder::class);
        $this->call(EmailSettingSeeder::class);
        $this->call(BlogCategorySeeder::class);
        $this->call(PropertyTypesSeeder::class);
        $this->call(ContactSeeder::class);
    }
}
