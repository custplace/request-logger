<?php

namespace Custplace\requestLogger\Providers;

use Illuminate\Support\ServiceProvider;
use Custplace\requestLogger\Http\Middleware\RequestLogMiddleware;
use Illuminate\Routing\Router;

class requestLogProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/request-log.php' => config_path('request-log.php'),
        ]);
        $this->loadRoutesFrom(__DIR__.'/../../routes/RequestLogTestingRoutes.php');
        
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('log', RequestLogMiddleware::class);
    }
}