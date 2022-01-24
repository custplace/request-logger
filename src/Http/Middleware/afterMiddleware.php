<?php

namespace Simo\requestLogger\Http\Middleware;

use Closure;
use Simo\requestLogger\Models\RequestLogModel;

class AfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // Save request end time
        $request->end = microtime(true);
        $db_name = config('database.default');
        $LogModel = new RequestLogModel;
        $test = $LogModel->setConnection($db_name);
        dd($test);
        RequestLogModel::logRequest($request, $response);

        return $response;
    }
}