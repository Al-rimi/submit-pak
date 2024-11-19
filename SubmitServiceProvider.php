<?php

namespace AlRimi\Submit;

use Illuminate\Support\ServiceProvider;

class SubmitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/src/routes/submit.php');
        $this->loadMigrationsFrom(__DIR__ . '/src/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/src/resources/views', 'submit');

        $this->publishes([
            __DIR__ . '/src/config/submit.php' => config_path('submit.php'),
            __DIR__ . '/src/database/migrations' => database_path('migrations'),
            __DIR__ . '/src/database/seeders' => database_path('seeders'),
            __DIR__ . '/src/resources/views' => resource_path('views'),
            __DIR__ . '/src/resources/css' => resource_path('css'),
            __DIR__ . '/src/resources/js' => resource_path('js'),
            __DIR__ . '/src/resources/images' => public_path('images'),
        ], 'laravel-assets');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge package configuration
        $this->mergeConfigFrom(
            __DIR__ . '/src/config/submit.php',
            'submit'
        );

        $this->registerCommands();
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \AlRimi\Submit\UpdateViteConfigCommand::class,
            ]);
        }
    }

}
