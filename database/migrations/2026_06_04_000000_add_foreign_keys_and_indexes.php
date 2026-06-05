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
        // Add foreign key for reservations.user_id
        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->index('booking_date');
            $table->index('status');
        });

        // Add foreign keys for reservation_items
        Schema::table('reservation_items', function (Blueprint $table) {
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict');
        });

        // Add index for services.is_active
        Schema::table('services', function (Blueprint $table) {
            $table->index('is_active');
        });

        // Add index for products.is_active
        Schema::table('products', function (Blueprint $table) {
            $table->index('is_active');
        });

        // Add index for promotions.is_active
        Schema::table('promotions', function (Blueprint $table) {
            $table->index('is_active');
        });

        // Add index for galleries.category
        Schema::table('galleries', function (Blueprint $table) {
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropIndex(['booking_date']);
            $table->dropIndex(['status']);
        });

        Schema::table('reservation_items', function (Blueprint $table) {
            $table->dropForeign(['reservation_id']);
            $table->dropForeign(['service_id']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndex(['category']);
        });
    }
};
