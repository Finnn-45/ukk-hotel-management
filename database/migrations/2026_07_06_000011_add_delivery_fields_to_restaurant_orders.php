<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurant_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('restaurant_orders', 'delivery_address')) {
                $table->text('delivery_address')->nullable()->after('total_amount');
            }
            $table->string('delivery_city_id')->nullable();
            $table->string('delivery_province_id')->nullable();
            $table->string('delivery_postal_code')->nullable();
            $table->string('shipping_courier')->nullable();
            $table->string('shipping_service')->nullable();
            $table->decimal('shipping_cost', 12, 2)->nullable();
            $table->string('estimated_delivery')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('restaurant_orders', function (Blueprint $table) {
            $columns = [
                'delivery_city_id',
                'delivery_province_id',
                'delivery_postal_code',
                'shipping_courier',
                'shipping_service',
                'shipping_cost',
                'estimated_delivery',
            ];

            if (Schema::hasColumn('restaurant_orders', 'delivery_address') && !Schema::hasColumn('restaurant_orders', 'order_type')) {
                $columns[] = 'delivery_address';
            }

            $table->dropColumn($columns);
        });
    }
};