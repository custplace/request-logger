<?php

namespace App\Http\Middleware;
use Custplace\requestLogger\Models\RequestLogTest;

use Closure;

class requestLogTestmiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // Save request end time
        $request->end = microtime(true);
        try {
            RequestLogTest::logRequest($request, $response);
        }
        catch(\Exception $e) {
            report($e);
        }

        return $response;
    }
}