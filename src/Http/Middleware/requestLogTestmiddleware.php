<?php

namespace App\Http\Middleware;
use Custplace\requestLogger\Models\RequestLogTestModel;

use Closure;

class requestLogTestmiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // Save request end time
        $request->end = microtime(true);
        try {
            $newLog = RequestLogTestModel::logRequest($request, $response);
            $response->id = $newLog->id;
        }
        catch(\Exception $e) {
            report($e);
        }

        return $response;
    }
}