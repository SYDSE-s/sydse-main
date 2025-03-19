<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'account_name',
        'account_number',
        'is_active'
    ];

    /**
     * Get the orders for the payment method
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
