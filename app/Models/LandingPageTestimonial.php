<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageTestimonial extends Model
{
    protected $fillable = [
        'name',
        'position',
        'message',
        'avatar',
        'rating',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}