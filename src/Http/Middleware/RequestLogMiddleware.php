<?php

namespace Custplace\requestLogger\Http\Middleware;
use Custplace\requestLogger\Models\RequestLog;

use Closure;

class RequestLogMiddleware
{
    public function handle($request, Closure $next)
    {
        // Save request start time
        $request->start = microtime(true);

        return $next($request);
    }

    public function terminate($request, $response)
    {
        // Save request end time
        $request->end = microtime(true);

        try {
            RequestLog::logRequest($request, $response);
        } catch (\Exception $e) {
            report($e);
        }
    }
}