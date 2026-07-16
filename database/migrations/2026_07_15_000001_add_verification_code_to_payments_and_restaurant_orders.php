<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('verification_code')->nullable()->unique()->after('midtrans_order_id');
        });

        Schema::table('restaurant_orders', function (Blueprint $table) {
            $table->string('verification_code')->nullable()->unique()->after('order_number');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('verification_code');
        });

        Schema::table('restaurant_orders', function (Blueprint $table) {
            $table->dropColumn('verification_code');
        });
    }
};