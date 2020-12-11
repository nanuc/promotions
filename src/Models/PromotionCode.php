<?php

namespace Nanuc\Promotions\Models;

use Illuminate\Database\Eloquent\Model;
use Nanuc\Promotions\Exceptions\PromotionCodeIsAlreadyRedeemedException;

class PromotionCode extends Model
{
    protected $casts = [
        'redeemed_at' => 'datetime',
    ];

    public function promotionReceiver()
    {
        return $this->belongsTo(PromotionReceiver::class);
    }

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
        if($this->isAlreadyRedeemed) {
            throw new PromotionCodeIsAlreadyRedeemedException('Promotion code ' . $this->code . ' is already redeemed.');
        }

        $this->redeemed_at = now();
        $this->save();

        return $this->promotion->getHandler()->redeemCode($this);
    }

    public function generateUrlIdentifier()
    {
        $urlIdentifierGeneratorClassName = config('promotions.promotion-url-identifier.generator');
        $this->url_identifier = (new $urlIdentifierGeneratorClassName)->createUrlIdentifier();
        $this->save();
    }
}
