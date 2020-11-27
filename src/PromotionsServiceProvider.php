<?php

namespace Nanuc\Promotions;

use Nanuc\Helpers\View\Components\Tabs\TabContent;
use Nanuc\Helpers\View\Components\Tabs\TabLink;
use Nanuc\Helpers\View\Components\Tabs\Tabs;
use Illuminate\Support\ServiceProvider;
use Nanuc\Helpers\View\Components\DateTime;
use Nanuc\Helpers\View\Components\HelpscoutBeacon;

class PromotionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/promotions.php' => config_path('promotions.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/create_promotion_table.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_promotion_tables.php'),
        ], 'migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/promotions.php', 'promotions');
    }
}