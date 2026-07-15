<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'booking_id', 'restaurant_order_id', 'payment_method', 'payment_status', 'amount', 'midtrans_order_id', 'proof_of_payment', 'rejection_reason', 'paid_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function restaurantOrder(): BelongsTo
    {
        return $this->belongsTo(RestaurantOrder::class);
    }
}