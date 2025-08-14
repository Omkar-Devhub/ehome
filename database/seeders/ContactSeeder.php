<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contact = new ContactSetting();
        $contact->address = '6 Fern Road, Sandyford, Dublin D18 FP98';
        $contact->phone = '+353 87 4735431';
        $contact->email = 'info@eirehome.ie';
        $contact->approver_email = 'verification@eirehome.ie';
        $contact->sales_email = 'sales@eirehome.ie';
        $contact->save();
    }
}
