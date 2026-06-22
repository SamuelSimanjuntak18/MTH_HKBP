<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $fillable = [
        'coupon_id',
        'prize_name',
        'drawn_at',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
