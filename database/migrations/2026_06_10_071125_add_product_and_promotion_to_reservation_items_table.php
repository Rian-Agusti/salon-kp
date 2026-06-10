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
        Schema::table('reservation_items', function (Blueprint $table) {
            // Make service fields nullable
            $table->unsignedBigInteger('service_id')->nullable()->change();
            $table->string('service_name', 150)->nullable()->change();

            // Add product fields
            $table->unsignedBigInteger('product_id')->nullable()->after('service_duration');
            $table->string('product_name', 150)->nullable()->after('product_id');
            $table->integer('product_quantity')->default(1)->after('product_name');

            // Add promotion fields
            $table->unsignedBigInteger('promotion_id')->nullable()->after('product_quantity');
            $table->string('promotion_name', 150)->nullable()->after('promotion_id');

            // Item generic fields
            $table->enum('type', ['service', 'product', 'promotion'])->default('service')->after('reservation_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_items', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable(false)->change();
            $table->string('service_name', 150)->nullable(false)->change();

            $table->dropColumn([
                'product_id',
                'product_name',
                'product_quantity',
                'promotion_id',
                'promotion_name',
                'type'
            ]);
        });
    }
};
