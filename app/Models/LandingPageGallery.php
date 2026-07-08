<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageGallery extends Model
{
    protected $fillable = [
        'title',
        'image',
        'category',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}