<?php

namespace Custplace\requestLogger\Http\Middleware;

use Closure;
use Custplace\requestLogger\Models\RequestLogTest;
use DB;

class RequestLogAfterMiddlewareTest
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // Save request end time
        $request->end = microtime(true);
        try {
            $new_log_id = RequestLogTest::logRequest($request, $response);
            $response->id = $new_log_id;
        }
        catch(\Exception $e) {
            report($e);
        }

        return $response;
    }
}