<?php

namespace Database\Seeders;

use App\Models\MaintenanceMode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaintenanceModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maintenanceMode = new MaintenanceMode;
        $maintenanceMode->message = 'We are currently under maintenance. Please check back later.';
        $maintenanceMode->status = 0;
        $maintenanceMode->save();
    }
}
