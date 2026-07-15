<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'booking_id', 'user_id', 'room_id', 'restaurant_order_id', 'review_type', 'rating', 'review', 'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function restaurantOrder()
    {
        return $this->belongsTo(RestaurantOrder::class, 'restaurant_order_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}