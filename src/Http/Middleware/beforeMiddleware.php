<?php

namespace Simo\requestLogger\Http\Middleware;

use Closure;

class BeforeMiddleware
{
    public function handle($request, Closure $next)
    {
        // Save request start time
        $request->start = microtime(true);

        return $next($request);
    }
}