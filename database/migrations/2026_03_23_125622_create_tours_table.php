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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('duration')->nullable();

            $table->decimal('price_usd', 10, 2)->nullable();
            $table->decimal('price_eur', 10, 2)->nullable();
            $table->decimal('price_ghs', 10, 2)->nullable();
            $table->integer('max_guests');
            $table->string('category')->nullable(); // e.g., "Adventure", "Cultural", "Relaxation"

            // JSON fields for arrays
            $table->json('inclusions')->nullable();
            $table->json('exclusions')->nullable();
            $table->json('images')->nullable();

            $table->boolean('is_featured')->default(false);

            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
