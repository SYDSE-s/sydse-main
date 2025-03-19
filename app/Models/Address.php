<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'province',
        'city',
        'district',
        'postal_code',
        'phone',
        'is_default'
    ];

    /**
     * Get the user that owns the address
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders for the address
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
