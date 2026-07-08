<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingPageSection extends Model
{
    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'content',
        'image',
        'metadata',
        'order',
        'is_active',
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_active' => 'boolean',
    ];
}