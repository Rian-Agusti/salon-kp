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
            $table->date('member_until')->nullable()->after('phone');
            $table->date('birth_date')->nullable()->after('member_until');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->decimal('discount_amount', 12, 2)->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('discount_amount');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['member_until', 'birth_date']);
        });
    }
};
