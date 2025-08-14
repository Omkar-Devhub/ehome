<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hero = new HeroSection;
        $hero->title = 'Find Your Dream Property';
        $hero->subtitle = 'Explore the best properties for sale, rent, or buy';
        $hero->image = 'hero_image_1740675601.jpg';
        $hero->save();
    }
}
