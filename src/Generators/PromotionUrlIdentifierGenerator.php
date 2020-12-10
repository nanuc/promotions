<?php

namespace Nanuc\Promotions\Generators;

use Illuminate\Support\Arr;
use Nanuc\Promotions\Models\PromotionCode;
use Str;

class PromotionUrlIdentifierGenerator
{
    public function createUrlIdentifier()
    {
        $allUrlIdentifiers = PromotionCode::get('url_identifier')->pluck('url_identifier');

        do {
            $urlIdentifier = Str::random();
        } while($allUrlIdentifiers->contains($urlIdentifier));

        return $urlIdentifier;
    }
}
