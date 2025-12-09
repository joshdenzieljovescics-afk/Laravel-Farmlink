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
            $table->unsignedBigInteger('accID')->nullable()->after('id');
            $table->foreign('accID')->references('id')->on('users')->onDelete('cascade');
            $table->string('status')->default('Y')->after('is_organic');  // Y = active, N = inactive/deleted
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['accID']);
            $table->dropColumn(['accID', 'status']);
        });
    }
};
