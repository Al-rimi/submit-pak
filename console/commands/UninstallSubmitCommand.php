<?php

namespace AlRimi\Submit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UninstallSubmitCommand extends Command
{

    protected $signature = 'submit:uninstall';
    protected $description = 'Uninstall the Submit package by removing its resources.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting Submit package uninstallation...');

        // Remove configuration file
        $this->deleteFile(config_path('submit.php'), 'configuration file');

        // Remove views
        $this->deleteFile(resource_path('views/submission.blade.php'), 'submission view');
        $this->deleteFile(resource_path('views/email/submission_email.blade.php'), 'email view');

        // Remove assets
        $this->deleteFile(public_path('images/ggak71.png'), 'image asset');

        // Remove migrations and seeders
        $this->deleteFile(database_path('migrations/2024_09_17_163213_create_students_table.php'), 'migration');
        $this->deleteFile(database_path('seeders/StudentsTableSeeder.php'), 'seeder');

        // Remove CSS and JS files
        $this->deleteFile(resource_path('css/submit.css'), 'CSS file');
        $this->deleteFile(resource_path('js/submit.js'), 'JavaScript file');

        // Reverse Vite configuration changes
        $this->reverseViteConfig();

        $this->info('Submit package uninstallation completed.');
        return 0;
    }

    /**
     * Reverse changes made to vite.config.js.
     */
    protected function reverseViteConfig()
    {
        $viteConfigPath = base_path('vite.config.js');

        if (File::exists($viteConfigPath)) {
            $viteConfig = file_get_contents($viteConfigPath);
            $pattern = "/'resources\/css\/submit\.css',\s*'resources\/js\/submit\.js',?\s*/";

            if (preg_match($pattern, $viteConfig)) {
                $viteConfig = preg_replace($pattern, '', $viteConfig);
                file_put_contents($viteConfigPath, $viteConfig);
                $this->info('vite.config.js has been reverted.');
            } else {
                $this->info('No Submit assets found in vite.config.js.');
            }
        } else {
            $this->warn('vite.config.js not found. Skipping Vite configuration reversal.');
        }
    }

    /**
     * Delete a file and log the result.
     *
     * @param string $filePath
     * @param string $description
     */
    protected function deleteFile($filePath, $description)
    {
        if (File::exists($filePath)) {
            File::delete($filePath);
            $this->info("Deleted $description: $filePath");
        } else {
            $this->info("$description not found: $filePath");
        }
    }
}
