<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $guarded = [];
    // protected $fillable =
    protected $fillable = [
        'business_name',
        'business_category',
        'business_duration',
        'owner_name',
        'email',
        'phone_number',
        'province',
        'city',
        'sub_district',
        'village',
        'id_card_number',
        'id_card_photo',
        'id_card_selfie',
        'product_photo',
        'bank_name',
        'bank_account_number',
        'bank_holders_name',
        'qrcode'
    ];

    // protected $guarded = ['id'];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
