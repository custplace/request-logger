<?php

namespace Simo\requestLogger\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RequestLogModel extends Eloquent
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'requests_log';

    protected $casts = [
        'headers' => 'array',
        'request' => 'array',
        'response' => 'array',
    ];

    public static function logRequest(Request $request, $response): void
    {
        $log                   = new RequestLogModel();
        $log->app              = $request->getHost();
        $log->path             = $request->path();
        $log->headers          = $request->headers->all();
        $log->method           = $request->getMethod();
        $log->request          = $request->all();
        $log->response_code    = $response->status();
        $log->response_content = $response->getContent();
        $log->duration         = $request->end - $request->start;
        $log->ip               = $request->getClientIp();

        $log->save();
    }
}
