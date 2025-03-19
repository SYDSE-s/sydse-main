<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type', // 'percentage' or 'fixed'
        'discount_amount',
        'minimum_purchase',
        'valid_until',
        'is_active',
        'usage_limit',
        'usage_count',
        'description'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Scope a query to only include active promo codes.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where('valid_until', '>=', now())
                     ->where(function($q) {
                         $q->whereNull('usage_limit')
                           ->orWhereRaw('usage_count < usage_limit');
                     });
    }
}
