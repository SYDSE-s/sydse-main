<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = [
        'name',
        'description',
        'price',
        'product_photo',
        'member_id'
    ];

    /**
     * Get the member that owns the product
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Get the order details for the product
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
