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
        Schema::create('weather_reference', function (Blueprint $table) {
            $table->id('weather_id');
            $table->string('condition_name'); // contoh: 'Sunny', 'Rainy', 'Cloudy'
            $table->string('icon_code');
            $table->integer('security_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_reference');
    }
};
