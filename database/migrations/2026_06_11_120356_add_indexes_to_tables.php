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
        Schema::table('users', function (Blueprint $table) {
            $table->index('name');
            $table->index('phone');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->index('status');
            $table->index('booking_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['phone']);
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['booking_date']);
        });
    }
};
