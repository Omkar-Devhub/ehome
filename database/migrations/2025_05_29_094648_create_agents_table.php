<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('profile_picture')->nullable();

            $table->string('business_type')->nullable()->comment("Individual, Company");
            $table->string('company_name')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_registration_number')->nullable();
            $table->string('psra_license_number')->unique();
            $table->string('license_expiry_date')->nullable();
            $table->string('vat_registration_number')->nullable();
            $table->string('business_email')->nullable();
            $table->string('business_phone')->nullable();
            $table->text('description')->nullable();
            $table->string('role')->nullable();

            $table->text('office_address')->nullable();
            $table->string('area_id')->nullable();
            $table->string('county_id')->nullable();
            $table->string('eircode')->nullable();
            $table->json('service_areas')->nullable();

            $table->string('languages')->nullable();
            $table->string('availability')->nullable();
            $table->string('specialties')->nullable();

            $table->string('password');
            $table->boolean('email_verified')->default(false);
            $table->boolean('terms_accepted')->default(false);
            $table->boolean('gdpr_accepted')->default(false);
            $table->boolean('marketing_opt_in')->default(false);
            $table->boolean('status')->default(0)->comment('0 = Inactive, 1 = Active, 2 = Deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
