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
        Schema::create('crowd_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')
                ->constrained('iot_devices')
                ->cascadeOnDelete();

            $table->dateTime('timestamp');
            $table->integer('occupancy_count');

            $table->foreignId('weather_id')
                ->constrained('weather_reference')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crowd_metrics');
    }
};
