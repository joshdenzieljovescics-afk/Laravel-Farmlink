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
        // First, add the column as nullable
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'order_number')) {
                $table->string('order_number')->nullable()->after('user_id');
            }
        });

        // Update existing records with order numbers
        $orders = \App\Models\Order::whereNull('order_number')->orWhere('order_number', '')->get();
        foreach ($orders as $order) {
            $order->order_number = \App\Models\Order::generateOrderNumber();
            $order->save();
        }

        // Make it unique
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'order_number')) {
                $table->dropColumn('order_number');
            }
        });
    }
};
