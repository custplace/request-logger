<?php

namespace Simo\requestLogger\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallDB extends Command
{
    protected $signature = 'DB:install';

    protected $description = 'Install the database type';

    public function handle()
    {
        $this->info('Installing laravel Logger package');

        $this->info('Publishing configuration...');
        $type = $this->choice(
            'choose a type',
            ['Mongo', 'Mysql'],
            1
        );
        if($type == 'mongo')
        {
            $this->command->info("Mongo been selected");
        }

        $this->info('Installed BlogPackage');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function type()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "JohnDoe\BlogPackage\BlogPackageServiceProvider",
            '--tag' => "config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

       $this->call('vendor:publish', $params);
    }
}