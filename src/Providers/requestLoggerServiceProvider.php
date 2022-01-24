<?php

namespace Simo\requestLogger\Providers;

use Illuminate\Support\ServiceProvider;
use Simo\requestLogger\Http\Middleware\beforeMiddleware;
use Simo\requestLogger\Http\Middleware\afterMiddleware;
use Illuminate\Routing\Router;

class requestLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/');
        $this->loadRoutesFrom(__DIR__.'/../../routes/test.php');
        $this->publishes([
            __DIR__.'/../../config/requestLogger.php' => config_path('requestLogger.php'),
          ], 'config');
        $this->app->make(\Illuminate\Contracts\Http\Kernel::class)
            ->pushMiddleware(beforeMiddleware::class)
            ->pushMiddleware(afterMiddleware::class);

        dd('test');
    }
}