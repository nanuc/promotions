<?php

return [
    'landing-page' => [
        'url' => [
            'prefix' => '/promotions/',
            'generator' => \Nanuc\Promotions\PromotionUrlGenerator::class,
        ]
    ],
    'views' => [
        'path' => 'promotions'
    ],
];