<?php

namespace Custplace\requestLogger\Http\Middleware;

use Closure;
use Custplace\requestLogger\Models\RequestLog;
use DB;

class RequestLogAfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // Save request end time
        $request->end = microtime(true);
        RequestLog::logRequest($request, $response);

        return $response;
    }
}