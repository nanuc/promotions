<?php

namespace Nanuc\Promotions\Traits;

use Nanuc\Promotions\Models\Promotion;
use Nanuc\Promotions\Models\PromotionCode;

trait HasPromotions
{
    public function promotionCodes()
    {
        return $this->morphMany(PromotionCode::class, 'promotionable');
    }

    public function isMemberOfPromotion(Promotion $promotion)
    {
        return $this->promotionCodes->pluck('promotion')->contains($promotion);
    }
}
