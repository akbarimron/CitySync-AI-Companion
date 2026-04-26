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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('name');

            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            $table->text('description');

            $table->decimal('base_price', 12, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
