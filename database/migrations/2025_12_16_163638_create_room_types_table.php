<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('capacity');
            $table->decimal('price_usd', 10, 2);
            $table->decimal('price_eur', 10, 2);
            $table->decimal('price_ghs', 10, 2);
            $table->json('amenities')->nullable(); // Store amenity IDs as JSON array [1, 2, 3]
            $table->json('images'); // Store image URLs as JSON array
            $table->integer('total_rooms');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};
