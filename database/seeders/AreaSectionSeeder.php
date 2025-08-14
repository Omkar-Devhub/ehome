<?php

namespace Database\Seeders;

use App\Models\AreaSection;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AreaSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $area = new AreaSection;
        $area->title = 'Explore Popular Areas';
        $area->heading = 'Location For Your Dream Home';
        $area->status = 1;
        $area->save();
    }
}
