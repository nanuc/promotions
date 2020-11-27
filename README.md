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

### Import promotion receivers from an Excel file
You can import Excel files. All columns in table `promotion_receivers` will be recognized - all other columns will go into the column `additional_data`.
You can either prepare the Excel file before importing, or write a command that migrates the data from `additional_data` into the other columns.
```php
Excel::import(new PromotionReceiversImport, 'path/to/excel/file');
```

## Configuration
### Code Generator
By default the generated promotion code will be unique and a random string of length 5. You can write your own generator. You can set your code generator in the config (`promotions.promotion-code.generator).

```php
public function createCode()
{
    $allPromotionCodes = PromotionCode::get('code')->pluck('code');

    do {
        $code = Str::random(5);
    } while($allPromotionCodes->contains($code));

    return $code;
}
```

### URL Generator
A promotion's landing page will be `/promotions/{promotion-name}` by default. If you want to change this you have to setup a new class and reference it in the config (`promotions.landing-page.url.generator`).
The class must have exactly one method (`createUrl`).

```php
public function createUrl(Promotion $promotion)
{
    return '/promotions/' . Str::kebab($promotion->name);
}
```