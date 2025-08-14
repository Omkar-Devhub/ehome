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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('county_id')->constrained()->onDelete('cascade');
            $table->foreignId('area_id')->constrained()->onDelete('cascade');
            $table->string('eircode')->nullable();
            $table->string('address')->nullable();
            $table->string('slug')->unique();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('price')->nullable();
            $table->string('rent_type')->nullable();
            $table->string('selling_type')->nullable(); // For Sale
            $table->string('tax_designation')->nullable(); //For Sale
            $table->string('access')->nullable(); // For Parking
            $table->string('space_available')->nullable(); // For Parking
            $table->string('available_from')->nullable();
            $table->string('lease')->nullable();
            $table->string('single_bedrooms')->nullable();
            $table->string('double_bedrooms')->nullable();
            $table->string('twin_bedrooms')->nullable();
            $table->string('bath_rooms')->nullable();
            $table->string('preference')->nullable();
            $table->string('ber_id')->nullable();
            $table->string('ber_no')->nullable();
            $table->string('property_size')->nullable();
            $table->string('units')->nullable();
            $table->string('furnishing_status')->nullable();
            $table->longText('description')->nullable();
            $table->longText('video')->nullable();
            $table->string('built_in')->nullable();
            $table->string('views')->nullable();
            $table->string('is_featured')->nullable();
            $table->foreignId('ad_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_type_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('propertyable_id'); // Polymorphic ID
            $table->string('propertyable_type'); // Polymorphic type (User or Agent)
            $table->string('phone_number_visiblity')->default('1');
            $table->string('plan_id')->nullable();
            $table->string('status')->default('0');
            $table->string('comments')->nullable();
            $table->string('expiry')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
