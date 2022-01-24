<?php

namespace Simo\requestLogger\Http\Middleware;

use Closure;
use Simo\requestLogger\Models\RequestLogModel;
use Simo\requestLogger\Models\RequestLogModelMongo;

class AfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $db_name = config('database.default');
        // Save request end time
        $request->end = microtime(true);
        if($db_name === 'mongodb') {
            RequestLogModelMongo::logRequest($request, $response);
            return $response;
        }
        RequestLogModel::logRequest($request, $response);

        return $response;
    }
}