<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('cta_link');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->string('size')->nullable()->after('rating');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->text('excerpt')->nullable()->after('title');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->integer('width')->nullable()->after('image_url');
            $table->integer('height')->nullable()->after('width');
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('slides', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('places', function (Blueprint $table) {
            $table->dropColumn('size');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('excerpt');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['width', 'height']);
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};
