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
        if (Schema::hasColumn('places', 'images')) {
            Schema::table('places', function (Blueprint $table) {
                $table->renameColumn('images', 'image_url');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('places', 'image_url') && !Schema::hasColumn('places', 'images')) {
            Schema::table('places', function (Blueprint $table) {
                $table->renameColumn('image_url', 'images');
            });
        }
    }
};
