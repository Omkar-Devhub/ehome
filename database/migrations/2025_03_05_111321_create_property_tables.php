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
        Schema::create('ad_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('orders');
            $table->boolean('show_in_navbar')->default(1);
            $table->timestamps();
        });

        Schema::create('property_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('property_category_id')->constrained()->onDelete('cascade');
            $table->boolean('show_in_navbar')->default(1); // 1 = Show, 0 = Hide
            $table->timestamps();
        });

        Schema::create('ad_type_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_category_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_type_category');
        Schema::dropIfExists('property_types');
        Schema::dropIfExists('property_categories');
        Schema::dropIfExists('ad_types');
    }
};
