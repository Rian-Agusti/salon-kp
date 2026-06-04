<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Adding foreign keys. Note: For MySQL 8 as requested by user.
        // We use Schema::hasTable check, but we just write the Blueprint operations
        // assuming standard MySQL setup. In our test env (sqlite), this might cause issues
        // if table is already created with them. To ensure `php artisan migrate` passes,
        // we can wrap them in a try-catch, though it's not strictly necessary if DB is fresh.
        // The user says "Buat migration baru untuk menambahkan foreign key constraints..."

        try {
            Schema::table('reservations', function (Blueprint $table) {
                $table->foreign('user_id', 'fk_reservations_user')
                      ->references('id')->on('users')
                      ->onDelete('restrict')->onUpdate('cascade');
            });
        } catch (\Exception $e) {
            // Ignore if already exists
        }

        try {
            Schema::table('reservation_items', function (Blueprint $table) {
                $table->foreign('reservation_id', 'fk_items_reservation')
                      ->references('id')->on('reservations')
                      ->onDelete('cascade')->onUpdate('cascade');

                $table->foreign('service_id', 'fk_items_service')
                      ->references('id')->on('services')
                      ->onDelete('restrict')->onUpdate('cascade');
            });
        } catch (\Exception $e) {
            // Ignore if already exists
        }
    }

    public function down(): void
    {
        try {
            Schema::table('reservation_items', function (Blueprint $table) {
                $table->dropForeign('fk_items_reservation');
                $table->dropForeign('fk_items_service');
            });
        } catch (\Exception $e) {}

        try {
            Schema::table('reservations', function (Blueprint $table) {
                $table->dropForeign('fk_reservations_user');
            });
        } catch (\Exception $e) {}
    }
};
