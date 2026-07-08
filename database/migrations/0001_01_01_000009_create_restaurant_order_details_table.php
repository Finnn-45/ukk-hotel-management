<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurant_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_order_id')->constrained('restaurant_orders')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('restaurant_menus')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 12, 2);
            $table->decimal('subtotal', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurant_order_details');
    }
};