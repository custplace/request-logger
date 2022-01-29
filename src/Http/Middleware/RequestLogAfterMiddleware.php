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
        try {
            RequestLog::logRequest($request, $response);
        }
        catch(\Exception $e) {
            report($e);
        }

        return $response;
    }
}