<?php

namespace Nanuc\Promotions;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Nanuc\Promotions\Http\Controllers\LandingPageController;
use Nanuc\Promotions\Http\Livewire\RedeemCode;

class PromotionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/promotions.php' => config_path('promotions.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/create_promotion_tables.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_promotion_tables.php'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/promotions'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'promotions');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'promotions');

        Route::get(config('promotions.landing-page.url.prefix') . '{promotion}', LandingPageController::class);

        Livewire::component('redeem-code', RedeemCode::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/promotions.php', 'promotions');
    }
}