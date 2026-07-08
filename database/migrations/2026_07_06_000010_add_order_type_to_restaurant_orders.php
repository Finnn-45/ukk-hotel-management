<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurant_orders', function (Blueprint $table) {
            $table->enum('order_type', ['dine_in', 'delivery'])->default('dine_in')->after('notes');
            $table->text('delivery_address')->nullable()->after('order_type');
            $table->text('delivery_notes')->nullable()->after('delivery_address');
        });
    }

    public function down(): void
    {
        Schema::table('restaurant_orders', function (Blueprint $table) {
            $table->dropColumn(['order_type', 'delivery_address', 'delivery_notes']);
        });
    }
};