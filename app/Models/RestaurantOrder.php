<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RestaurantOrder extends Model
{
    protected $fillable = [
        'guest_id', 'order_number', 'table_number', 'order_date', 'total_amount', 'status', 'notes',
        'order_type', 'delivery_address', 'delivery_notes', 'verification_code',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(RestaurantOrderDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }


}
