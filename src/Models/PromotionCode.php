<?php

namespace Nanuc\Promotions\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    protected $casts = [
        'redeemed_at' => 'datetime',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public static function byCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function getIsAlreadyRedeemedAttribute()
    {
        return !is_null($this->redeemed_at);
    }

    public function redeem()
    {
        $this->redeemed_at = now();
        $this->save();

        return $this->promotion->getHandler()->redeemCode($this);
    }
}
