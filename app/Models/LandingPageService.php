<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageService extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'link',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}