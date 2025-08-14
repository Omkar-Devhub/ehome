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
        Schema::create('ad_type_property_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_type_id')->constrained('ad_types')->onDelete('cascade');
            $table->foreignId('property_type_id')->constrained('property_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_type_property_type');
    }
};
