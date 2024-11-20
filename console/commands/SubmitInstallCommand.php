<?php

namespace AlRimi\Submit\Console\Commands;

use Illuminate\Console\Command;

class SubmitInstallCommand extends Command
{
    protected $signature = 'submit:install';
    protected $description = 'Run installation steps for the Submit package';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->call('vendor:publish', ['--tag' => 'laravel-assets', '--force' => true]);
            $this->info('Assets published.');

            $this->runShellCommand('npm install', 'NPM dependencies installed.');
            
            $this->call('submit:update-vite');
            $this->info('Vite configuration updated.');

            $this->runShellCommand('npm run build', 'Assets built.');

            $this->call('migrate');
            $this->info('Database migrations completed.');

            $this->call('db:seed', ['--class' => 'StudentsTableSeeder']);
            $this->info('Database seeded.');

            $this->info('Submit package installation completed!');
        } catch (\Exception $e) {
            $this->error("Error: {$e->getMessage()}");
        }
    }

    /**
     * Run a shell command and handle errors.
     *
     * @param string $command
     * @param string $successMessage
     * @return void
     * @throws \Exception
     */
    protected function runShellCommand(string $command, string $successMessage)
    {
        $output = [];
        $returnVar = 0;

        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            throw new \Exception("Command failed: {$command}. Output: " . implode("\n", $output));
        }

        $this->info($successMessage);
    }
}
