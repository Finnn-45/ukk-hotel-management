<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurant_orders', function (Blueprint $table) {
            $table->enum('status', ['pending_payment', 'pending', 'preparing', 'ready', 'completed', 'cancelled'])->default('pending_payment')->change();
        });
    }

    public function down(): void
    {
        Schema::table('restaurant_orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'preparing', 'ready', 'completed', 'cancelled'])->default('pending')->change();
        });
    }
};