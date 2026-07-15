<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title',
        'code',
        'discount_type',
        'discount_value',
        'description',
        'image',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        $today = now()->toDateString();
        return $query->where('is_active', true)
            ->where('valid_from', '<=', $today)
            ->where('valid_until', '>=', $today);
    }
}
