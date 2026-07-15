<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelServiceRequest extends Model
{
    protected $fillable = [
        'guest_id',
        'booking_id',
        'service_type',
        'details',
        'status',
        'price',
        'receptionist_response',
    ];

    protected $casts = [
        'details' => 'array', // automatically casts JSON text to PHP array
        'price' => 'decimal:2',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
