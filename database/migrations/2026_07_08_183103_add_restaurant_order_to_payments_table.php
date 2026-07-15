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
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('booking_id')->nullable()->change();
            $table->foreignId('restaurant_order_id')->nullable()->after('booking_id')->constrained('restaurant_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['restaurant_order_id']);
            $table->dropColumn('restaurant_order_id');
            $table->foreignId('booking_id')->nullable(false)->change();
        });
    }
};
