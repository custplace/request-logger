<?php

namespace Custplace\requestLogger\Providers;

use Illuminate\Support\ServiceProvider;
use Custplace\requestLogger\Http\Middleware\RequestLogBeforeMiddleware;
use Custplace\requestLogger\Http\Middleware\RequestLogAfterMiddleware;
use Illuminate\Routing\Router;

class requestLogProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/request-log.php' => config_path('request-log.php'),
        ]);
        
        //$this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
        $this->loadRoutesFrom(__DIR__.'/../../routes/RequestLogTestingRoutes.php');
        $enabled = config('request-log.enabled');
        if($enabled) {
            $this->app->make(\Illuminate\Contracts\Http\Kernel::class)
            ->pushMiddleware(RequestLogBeforeMiddleware::class)
            ->pushMiddleware(RequestLogAfterMiddleware::class);
        }
    }
}