<?php

namespace Nanuc\Promotions;

use Nanuc\Promotions\Models\Promotion;
use Nanuc\Promotions\Models\PromotionCode;

abstract class PromotionHandler
{
    abstract public function redeemCode(PromotionCode $promotionCode);

    public static function make()
    {
        return new static;
    }

    public function addReceivers()
    {
        return $this->getPromotion();
    }

    public function handleLandingPage()
    {
        return view($this->getPromotion()->getView());
    }

    protected function getPromotion()
    {
        $promotion = Promotion::firstOrCreate([
            'handler' => get_class($this)
        ]);

        if($promotion->wasRecentlyCreated) {
            $urlGeneratorClassName = config('promotions.landing-page.url.generator');
            $promotion->url = (new $urlGeneratorClassName)->createUrl($promotion);
            $promotion->save();
        }

        return $promotion;
    }
}
