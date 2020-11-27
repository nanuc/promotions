## Installation

You can install the package via composer:

``` bash
composer require nanuc/promotions
```

The package will automatically register itself.

You can publish the migration with:
```bash
php artisan vendor:publish --provider="Nanuc\Promotions\PromotionsServiceProvider" --tag="migrations"
```

## Create a promotion
### The handler
Create a new class that extends `Nanuc\Promotions\PromotionHandler`.
```php
<?php

namespace App\Lib\Promotions;

use Nanuc\Promotions\PromotionHandler;

class Promotion2021StartsNow extends PromotionHandler
{

}
```

### The landing page
In your handler you can define what is supposed to happen when someone hits the landing page for your promotion.
```php
public function handleLandingPage()
{
    return 'You have reached the landing page!';
}
```
By default the package will look for a view in `resources/views/promotions/` (see config) with the name of the promotion, e.g. `promotion2021-starts-now`.
The view name is the name of the promotion in kebab case.

### Redeeming a code
In your handler you must define what is supposed to happen when someone redeems a valid code.
```php
public function redeemCode(PromotionCode $promotionCode)
{
    return redirect('/code-was-redeemed');
}
```

## Configuration
### URL Generator
A promotion's landing page will be `/promotions/{promotion-name}` by default. If you want to change this you have to setup a new class and reference it in the config (`promotion-url-generator`).
The class must have exactly one method (`createUrl`).

```php
public function createUrl(Promotion $promotion)
{
    return '/promotions/' . Str::kebab($promotion->name);
}
```