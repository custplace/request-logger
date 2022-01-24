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
        $db_name = config('database.default');
        DB::setDefaultConnection($db_name);
        RequestLogModel::logRequest($request, $response);

        return $response;
    }
}