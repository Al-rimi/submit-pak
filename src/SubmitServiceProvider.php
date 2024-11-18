<?php

namespace AlRimi\Submit;

use Illuminate\Support\ServiceProvider;

class SubmitServiceProvider extends ServiceProvider
{
    public function boot()
    {

        if (method_exists($this->app, 'make') && $this->app->bound('Illuminate\Database\Eloquent\Factory')) {
            $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/Database/Factories');
        }

        $this->publishes([
            __DIR__ . '/Config/submit.php' => config_path('submit.php'),
            __DIR__ . '/routes/submit.php' => routes_path(),
            __DIR__ . '/resources/views' => resource_path('views'),
            __DIR__ . '/resources/css' => resource_path('css'),
            __DIR__ . '/resources/js' => resource_path('js'),
            __DIR__ . '/resources/images' => public_path('images'),
            __DIR__ . '/seeders' => database_path('seeders'),
        ], 'laravel-assets');

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
