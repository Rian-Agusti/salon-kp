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
        try {
            if (Schema::hasTable('products') && Schema::hasColumn('products', 'stock')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->dropColumn('stock');
                });
            }
        } catch (\Exception $e) {
            // Ignore
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products~', function (Blueprint $table) {
            //
        });
    }
};
