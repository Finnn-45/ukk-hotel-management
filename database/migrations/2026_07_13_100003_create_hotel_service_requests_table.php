<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('service_type', ['laundry', 'extra_items', 'meeting_room', 'room_service', 'contact']);
            $table->text('details'); // JSON or text detailing the request details
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->decimal('price', 12, 2)->default(0.00);
            $table->text('receptionist_response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_service_requests');
    }
};
