<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'payment_method_id',
        'shipping_method_id',
        'order_number',
        'subtotal',
        'shipping_cost',
        'tax',
        'discount',
        'total',
        'promo_code',
        'status',
        'notes'
    ];

    /**
     * Get the user that owns the order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the address associated with the order
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Get the payment method associated with the order
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the shipping method associated with the order
     */
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    /**
     * Get the order details for the order
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
