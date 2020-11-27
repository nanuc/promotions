<?php

return [
    'landing-page' => [
        'url' => [
            'prefix' => '/promotions/',
            'generator' => \Nanuc\Promotions\Generators\PromotionUrlGenerator::class,
        ]
    ],
    'views' => [
        'path' => 'promotions'
    ],
    'promotion-code' => [
        'generator' => \Nanuc\Promotions\Generators\PromotionCodeGenerator::class,
    ]
];