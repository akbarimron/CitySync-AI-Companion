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
        Schema::create('itinerary_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_id')
                ->constrained('itineraries')
                ->onDelete('cascade');
            $table->foreignId('destination_id')
                ->constrained()
                ->onDelete('cascade');
            $table->dateTime('scheduled_time');
            $table->decimal('actual_price', 12, 2);
            $table->integer('priority_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary_items');
    }
};
