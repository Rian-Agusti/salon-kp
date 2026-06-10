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
            $table->enum('type', ['online', 'offline'])->default('online')->after('phone');
            $table->text('address')->nullable()->after('type');
            $table->text('notes')->nullable()->after('address');
            $table->boolean('is_active')->default(true)->after('notes');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('source', ['online', 'offline'])->default('online')->after('status');
            $table->enum('payment_status', ['paid', 'unpaid'])->default('paid')->after('source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['type', 'address', 'notes', 'is_active']);
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['source', 'payment_status']);
        });
    }
};
