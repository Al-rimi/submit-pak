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
        $this->loadRoutesFrom(__DIR__ . '/routes/submit.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'submit');

        $this->publishes([
            __DIR__ . '/config/submit.php' => config_path('submit.php'),
            __DIR__ . '/database/migrations' => database_path('migrations'),
            __DIR__ . '/database/seeders' => database_path('seeders'),
            __DIR__ . '/resources/views' => resource_path('views'),
            __DIR__ . '/resources/css' => resource_path('css'),
            __DIR__ . '/resources/js' => resource_path('js'),
            __DIR__ . '/resources/images' => public_path('images'),
        ], 'laravel-assets');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/submit.php',
            'submit'
        );

        $this->registerCommands();
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \AlRimi\Submit\Console\Commands\InstallSubmitCommand::class,
                \AlRimi\Submit\Console\Commands\UninstallSubmitCommand::class,
            ]);
        }
    }
}
