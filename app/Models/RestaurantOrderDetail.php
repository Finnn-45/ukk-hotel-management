<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantOrderDetail extends Model
{
    protected $fillable = [
        'restaurant_order_id', 'menu_id', 'quantity', 'price', 'subtotal',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(RestaurantOrder::class, 'restaurant_order_id');
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(RestaurantMenu::class, 'menu_id');
    }
}