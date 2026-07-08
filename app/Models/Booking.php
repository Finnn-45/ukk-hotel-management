<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'guest_id', 'room_id', 'check_in', 'check_out',
        'number_of_guests', 'total_price', 'status',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'number_of_guests' => 'integer',
        'total_price' => 'decimal:2',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
