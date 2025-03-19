<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cost',
        'estimated_days',
        'is_active'
    ];

    /**
     * Get the orders for the shipping method
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
