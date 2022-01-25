<?php

namespace Custplace\requestLogger\Http\Middleware;

use Closure;

class RequestLogBeforeMiddleware
{
    public function handle($request, Closure $next)
    {
        // Save request start time
        $request->start = microtime(true);

        return $next($request);
    }
}