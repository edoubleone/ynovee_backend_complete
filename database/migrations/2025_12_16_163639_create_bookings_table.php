<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_type_id')->constrained('room_types')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guests_count');
            $table->decimal('total_price', 10, 2);
            $table->string('currency', 3); // USD, EUR, GHS
            $table->string('status')->default('pending'); // pending, confirmed, checked_in, checked_out, cancelled
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
