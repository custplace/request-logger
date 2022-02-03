<?php

namespace Custplace\requestLogger\Http\Middleware;

use Closure;
use Custplace\requestLogger\Models\RequestLog;
use Illuminate\Support\Facades\Log;
use DB;

class RequestLogAfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // Save request end time
        $request->end = microtime(true);
        $shouldBeIgnored = config('request-log.uris_that_should_be_ignored');
        if(!in_array($request->path(), $shouldBeIgnored)) {
            try {
                RequestLog::logRequest($request, $response);
                Log::build([
                    'driver' => 'single',
                    'path' => config('request-log.file_path')
                ])->info($this->convert($request, $response));
            }
            catch(\Exception $e) {
                report($e);
            }
        }
        return $response;
    }

    public function convert($request, $response)
    {
        return json_encode([
            'app '             => $request->getHost(),
            'path'             => $request->path(),
            'headers'        => $request->headers->all(),
            'method'          => $request->getMethod(),
            'request'          => $request->all(),
            'response_code'   => $response->status(),
            'response_content' => $response->getContent(),
            'duration'         => $request->end - $request->start,
            'ip'              => $request->getClientIp(),
        ]);
    }

}