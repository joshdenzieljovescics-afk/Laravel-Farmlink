<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add new column names that the seller system uses
            $table->string('product_name')->nullable()->after('name');
            $table->string('product_category')->nullable()->after('category');
            $table->string('unit_measure')->nullable()->after('unit');
            $table->decimal('avail_qty', 10, 2)->nullable()->after('stock_quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'product_category', 'unit_measure', 'avail_qty']);
        });
    }
};
