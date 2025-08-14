<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogCategory::create(['name' => 'Real Estate', 'slug' => 'real-estate']);
        BlogCategory::create(['name' => 'Tips & Guides', 'slug' => 'tips-guides']);
    }
}
