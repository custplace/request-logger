<?php

namespace Custplace\requestLogger\Providers;

use Illuminate\Support\ServiceProvider;
use Custplace\requestLogger\Http\Middleware\RequestLogBeforeMiddleware;
use Custplace\requestLogger\Http\Middleware\RequestLogAfterMiddleware;
use Illuminate\Routing\Router;

class RequestLogProvider extends ServiceProvider
{
    public function boot()
    {
        //$this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
        $this->publishes([
            __DIR__.'/../config/requestLogConfig.php' => config_path('requestLogConfig.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/../../routes/RequestLogTestRoute.php');
        $this->app->make(\Illuminate\Contracts\Http\Kernel::class)
            ->pushMiddleware(RequestLogBeforeMiddleware::class)
            ->pushMiddleware(RequestLogAfterMiddleware::class);
    }
}