<?php

namespace Database\Seeders;

use App\Models\FeaturedSection;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeaturedSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $featured = new FeaturedSection;
        $featured->title = 'Featured';
        $featured->heading = 'Featured Properties';
        $featured->button_text = 'View All';
        $featured->button_link = 'properties';
        $featured->status = 1;
        $featured->save();
    }
}
