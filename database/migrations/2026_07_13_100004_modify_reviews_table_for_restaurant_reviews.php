<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Make columns nullable
            $table->foreignId('booking_id')->nullable()->change();
            $table->foreignId('room_id')->nullable()->change();
            
            // Add restaurant order link and review type
            $table->foreignId('restaurant_order_id')->nullable()->after('room_id')->constrained('restaurant_orders')->onDelete('cascade');
            $table->enum('review_type', ['hotel', 'restaurant'])->default('hotel')->after('restaurant_order_id');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Drop restaurant order key
            $table->dropForeign(['restaurant_order_id']);
            $table->dropColumn(['restaurant_order_id', 'review_type']);
            
            // Revert columns to not nullable
            $table->foreignId('booking_id')->nullable(false)->change();
            $table->foreignId('room_id')->nullable(false)->change();
        });
    }
};
