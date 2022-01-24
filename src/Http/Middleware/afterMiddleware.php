<?php

namespace Simo\requestLogger\Http\Middleware;

use Closure;
use Simo\requestLogger\Models\RequestLogModel;
use DB;

class AfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // Save request end time
        $request->end = microtime(true);
        RequestLogModel::logRequest($request, $response);

        return $response;
    }
}