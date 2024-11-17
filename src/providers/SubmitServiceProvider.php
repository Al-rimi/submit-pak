<?php

namespace AlRimi\Submit\Providers;

use Illuminate\Support\ServiceProvider;

class SubmitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/Config/submit.php' => config_path('submit.php'),
        ], 'config');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        // Load factories
        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/Database/Factories');

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'submit');

        // Publish assets (CSS, JS, Images)
        $this->publishes([
            __DIR__ . '/Resources/CSS' => public_path('vendor/submit/css'),
            __DIR__ . '/Resources/JS' => public_path('vendor/submit/js'),
            __DIR__ . '/Resources/Images' => public_path('vendor/submit/images'),
        ], 'assets');
    }

    public function register()
    {
        // Merge configuration
        $this->mergeConfigFrom(
            __DIR__ . '/Config/submit.php',
            'submit'
        );
    }
}
