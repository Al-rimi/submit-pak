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
        // Load factories if the Factory binding is available
        if (method_exists($this->app, 'make') && $this->app->bound('Illuminate\Database\Eloquent\Factory')) {
            $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/database/factories');
        }

        // Publish configuration, routes, views, assets, and seeders
        $this->publishes([
            __DIR__ . '/Config/submit.php' => config_path('submit.php'),
            __DIR__ . '/routes/submit.php' => base_path('routes/submit.php'),
            __DIR__ . '/resources/views' => resource_path('views'),
            __DIR__ . '/resources/css' => resource_path('css'),
            __DIR__ . '/resources/js' => resource_path('js'),
            __DIR__ . '/resources/images' => public_path('images'),
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'laravel-assets');

        // Publish migrations with unique timestamps
        $this->publishMigrations();
    }

    /**
     * Publish migrations with timestamped filenames.
     *
     * @return void
     */
    protected function publishMigrations()
    {
        $migrationsPath = __DIR__ . '/database/migrations';
        $targetPath = database_path('migrations');

        foreach (glob($migrationsPath . '/*.php') as $file) {
            $filename = basename($file);

            if (!file_exists($targetPath . '/' . $filename)) {
                $timestamp = date('Y_m_d_His');
                $newFilename = $timestamp . '_' . $filename;

                copy($file, $targetPath . '/' . $newFilename);
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge package configuration with application configuration
        $this->mergeConfigFrom(
            __DIR__ . '/Config/submit.php',
            'submit'
        );
    }
}
