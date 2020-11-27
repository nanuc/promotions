<?php

namespace Nanuc\Promotions;

use Illuminate\Support\Str;
use Nanuc\Promotions\Models\Promotion;

class PromotionUrlGenerator
{
    public function createUrl(Promotion $promotion)
    {
        return Str::kebab($promotion->name);
    }
}