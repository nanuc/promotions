<?php

namespace Nanuc\Promotions\Generators;

use Illuminate\Support\Arr;
use Nanuc\Promotions\Models\PromotionCode;

class PromotionCodeGenerator
{
    public function createCode()
    {
        $characters = str_split('ABCDEFGHJKLMNOPRSTUVWZ');

        $allPromotionCodes = PromotionCode::get('code')->pluck('code');

        do {
            $code = '';

            for ($i = 0; $i < 5; $i++) {
                $code .= Arr::random($characters);
            }
        } while($allPromotionCodes->contains($code));

        return $code;
    }
}
