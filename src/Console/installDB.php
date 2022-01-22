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
        if($type == 'Mongo')
        {
            $this->info("Mongo been selected");
        }

        $this->info('Installed BlogPackage');
    }
}