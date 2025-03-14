<?php

namespace Newelement\LaravelBlockBots;

use Illuminate\Support\ServiceProvider;
use Newelement\LaravelBlockBots\Commands\ListWhitelist;
use Newelement\LaravelBlockBots\Commands\ClearWhitelist;

class BlockBotsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {
            $this->commands([
                ListWhitelist::class,
                ClearWhitelist::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/config/block-bots.php' => config_path('block-bots.php'),
        ], 'config');

        $this->loadViewsFrom(__DIR__ . '/views', 'block-bots');

        $this->publishes([
            __DIR__ . '/views' => resource_path('views/vendor/block-bots'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/block-bots.php',
            'block-bots'
        );
    }
}
