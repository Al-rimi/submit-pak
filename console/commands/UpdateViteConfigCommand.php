<?php

namespace AlRimi\Submit\Console\Commands;

use Illuminate\Console\Command;

class UpdateViteConfigCommand extends Command
{
    protected $signature = 'submit:update-vite';
    protected $description = 'Add package assets to vite.config.js';

    public function handle()
    {
        $viteConfigPath = base_path('vite.config.js');

        if (!file_exists($viteConfigPath)) {
            $this->error('vite.config.js not found.');
            return;
        }

        $viteConfig = file_get_contents($viteConfigPath);
        $newInputs = "'resources/css/submit.css', 'resources/js/submit.js'";

        if (!str_contains($viteConfig, $newInputs)) {
            $viteConfig = preg_replace(
                "/input:\s*\[(.*?)\]/s",
                "input: [$1, $newInputs]",
                $viteConfig
            );

            file_put_contents($viteConfigPath, $viteConfig);
            $this->info('vite.config.js updated with Submit assets.');
        } else {
            $this->info('Submit assets are already included in vite.config.js.');
        }
    }
}
