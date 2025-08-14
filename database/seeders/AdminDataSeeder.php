<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new Admin;
        $admin->name = 'Admin';
        $admin->email = 'admin@eirehome.ie';
        $admin->phone = '+353 87 4735431';
        $admin->photo = '';
        $admin->password = Hash::make('Asdf@2468');
        $admin->token = "";
        $admin->save();
    }
}
