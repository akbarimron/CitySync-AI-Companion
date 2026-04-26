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
            $table->bigIncrements('metric_id');
            $table->foreignId('device_id')
                ->constrained('iot_devices', 'device_id')
                ->cascadeOnDelete();

            $table->dateTime('timestamp');
            $table->integer('occupancy_count');

            $table->unsignedBigInteger('weather_id');
            $table->foreign('weather_id')
                ->references('weather_id')
                ->on('weather_reference')
                ->cascadeOnDelete();
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
