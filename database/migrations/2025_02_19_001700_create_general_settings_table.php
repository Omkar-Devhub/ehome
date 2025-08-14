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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('webiste_title');
            $table->string('logo');
            $table->string('favicon');
            $table->string('language');
            $table->string('currency');
            $table->string('currency_symbol');
            $table->string('timezone');
            $table->string('copyright_text');
            $table->string('back_to_top')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
