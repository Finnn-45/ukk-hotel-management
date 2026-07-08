<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('landing_page_galleries')) {
            Schema::create('landing_page_galleries', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('image');
                $table->string('category')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('landing_page_testimonials')) {
            Schema::create('landing_page_testimonials', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('position')->nullable();
                $table->text('message');
                $table->string('avatar')->nullable();
                $table->integer('rating')->default(5);
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_page_galleries');
        Schema::dropIfExists('landing_page_testimonials');
    }
};