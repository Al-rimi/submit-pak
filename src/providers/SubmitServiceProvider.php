<?php

namespace AlRimi\Submit\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

class SubmitServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register any bindings or services here.
        // For example, registering a custom service or configuration.
        // Config::set('submit.some_config', 'value');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes from the routes file
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        
        // Optionally, publish configuration or other resources
        // $this->publishes([
        //     __DIR__ . '/../Config/submit.php' => config_path('submit.php'),
        // ], 'submit-config');
        
        // Load views if applicable (e.g., for emails or other templates)
        // $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'submit');

        // Load migrations if any
        // $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        // If you have custom validation rules or any other services to bind, you can register them here
    }
}
