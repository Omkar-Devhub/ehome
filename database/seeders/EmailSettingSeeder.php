<?php

namespace Database\Seeders;

use App\Models\EmailSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emailSetting = new EmailSetting;
        $emailSetting->smtp_host = 'sandbox.smtp.mailtrap.io';
        $emailSetting->smtp_port = '25';
        $emailSetting->encryption = 'tls';
        $emailSetting->smtp_username = '0b4b15c757cb14';
        $emailSetting->smtp_password = 'b029f348badde6';
        $emailSetting->from_email = 'admin@eirehome.ie';
        $emailSetting->from_name = 'Eirehome';
        $emailSetting->status = '1';
        $emailSetting->save();
    }
}
