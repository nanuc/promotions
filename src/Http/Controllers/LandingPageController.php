<?php

namespace Nanuc\Promotions\Http\Controllers;

use Nanuc\Promotions\Models\Promotion;

class LandingPageController
{
    public function __invoke($promotion)
    {
        $promotion = Promotion::byUrl($promotion);
        return $promotion->getHandler()->handleLandingPage();
    }
}