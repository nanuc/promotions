<?php

namespace Nanuc\Promotions\Generators;

use Illuminate\Support\Str;
use Nanuc\Promotions\Models\Promotion;
use Nanuc\Promotions\Models\PromotionCode;

class PromotionCodeGenerator
{
    public function createCode()
    {
        $allPromotionCodes = PromotionCode::get('code')->pluck('code');

        do {
            $code = Str::random(5);
        } while($allPromotionCodes->contains($code));

        return $code;
    }
}