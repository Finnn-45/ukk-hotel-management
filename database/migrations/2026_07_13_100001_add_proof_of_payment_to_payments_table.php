<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('proof_of_payment')->nullable()->after('midtrans_order_id');
            $table->text('rejection_reason')->nullable()->after('proof_of_payment');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['proof_of_payment', 'rejection_reason']);
        });
    }
};
