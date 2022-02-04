<?php

namespace Custplace\requestLogger\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Custplace\requestLogger\Models\RequestLog;

class RequestLogAfterMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        // Save request end time
        $request->end    = microtime(true);
        $shouldBeIgnored = config('request-log.ignored_urls');

        if (!in_array($request->path(), $shouldBeIgnored)) {
            try {
                // Save to database
                RequestLog::logRequest($request, $response);
                // Log to file
                Log::build([
                    'driver' => 'single',
                    'path'   => config('request-log.file_path')
                ])
                ->info($this->convert($request, $response));
            }
            catch (\Exception $e) {
                report($e);
            }
        }
        
        return $response;
    }

    public function convert($request, $response)
    {
        return json_encode([
            'ip'               => $request->getClientIp(),
            'app '             => $request->getHost(),
            'path'             => $request->path(),
            'headers'          => $request->headers->all(),
            'method'           => $request->getMethod(),
            'request'          => $request->all(),
            'response_code'    => $response->status(),
            'response_content' => $response->getContent(),
            'duration'         => $request->end - $request->start
        ]);
    }

}