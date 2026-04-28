<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('category_id');
            $table->boolean('is_featured')->default(false)->after('base_price');
            $table->unsignedSmallInteger('featured_rank')->default(0)->after('is_featured');
            $table->json('metadata')->nullable()->after('featured_rank');
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'is_featured', 'featured_rank', 'metadata']);
        });
    }
};