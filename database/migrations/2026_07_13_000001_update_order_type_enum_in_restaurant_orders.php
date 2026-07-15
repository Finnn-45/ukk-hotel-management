<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurant_orders', function (Blueprint $table) {
            // Update enum to include 'takeaway' option
            $table->enum('order_type', ['dine_in', 'takeaway', 'delivery'])->default('dine_in')->after('notes')->change();
        });
    }

    public function down(): void
    {
        Schema::table('restaurant_orders', function (Blueprint $table) {
            // Revert to original enum without 'takeaway'
            $table->enum('order_type', ['dine_in', 'delivery'])->default('dine_in')->after('notes')->change();
        });
    }
};