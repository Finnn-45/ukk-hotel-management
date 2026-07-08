<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // hero, about, services, gallery, etc.
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->json('metadata')->nullable(); // Additional data like buttons, links, etc.
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('landing_page_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('landing_page_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('category')->nullable(); // room, restaurant, facility, etc.
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

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

    public function down(): void
    {
        Schema::dropIfExists('landing_page_sections');
        Schema::dropIfExists('landing_page_services');
        Schema::dropIfExists('landing_page_galleries');
        Schema::dropIfExists('landing_page_testimonials');
    }
};