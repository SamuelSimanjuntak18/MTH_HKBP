<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon_number',
        'coupon_type',
        'reward_for_pic',
        'owner_name',
        'buyer_name',
        'buyer_phone',
        'price',
        'paid_amount',
        'payment_status',
        'payment_percent',
        'input_by',
        'sold_at',
        'note',
    ];

    public function winner()
    {
        return $this->hasOne(Winner::class);
    }
}
