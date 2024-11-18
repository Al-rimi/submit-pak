<?php

namespace AlRimi\Submit;

use Illuminate\Support\ServiceProvider;

class SubmitServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish configuration file
        $this->publishes([
            __DIR__ . '/Config/submit.php' => config_path('submit.php'),
        ], 'config');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        // Load factories if applicable
        if (method_exists($this->app, 'make') && $this->app->bound('Illuminate\Database\Eloquent\Factory')) {
            $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/Database/Factories');
        }

        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'submit');

        // Publish compiled assets (CSS, JS, Images)
        $this->publishes([
            __DIR__ . '/resources/css' => resource_path('css/vendor/submit'),
            __DIR__ . '/resources/js' => resource_path('js/vendor/submit'),
            __DIR__ . '/resources/images' => public_path('vendor/submit/images'),
        ], 'vite-assets');
        
    }

    public function register()
    {
        // Merge configuration file with the existing configuration
        $this->mergeConfigFrom(
            __DIR__ . '/Config/submit.php',
            'submit'
        );
    }
}
