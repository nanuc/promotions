<?php

namespace Nanuc\Promotions\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionReceiver extends Model
{
    protected $casts = [
        'additional_data' => 'array',
    ];

    public function createCodeForPromotion(Promotion $promotion)
    {
        $codeGeneratorClassName = config('promotions.promotion-code.generator');
        $urlIdentifierGeneratorClassName = config('promotions.promotion-url-identifier.generator');

        PromotionCode::create([
            'promotion_id' => $promotion->id,
            'promotion_receiver_id' => $this->id,
            'code' => (new $codeGeneratorClassName)->createCode(),
            'url_identifier' => (new $urlIdentifierGeneratorClassName)->createUrlIdentifier(),
        ]);
    }
}
