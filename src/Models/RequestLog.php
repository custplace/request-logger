<?php

namespace Custplace\requestLogger\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RequestLog extends Eloquent
{
    use HasFactory;
    protected $connection;
    protected $collection;

    function __construct($connection, $collection) {
        $this->$connection = $connection;
        $this->$collection = $collection;
    }

    protected $casts = [
        'headers' => 'array',
        'request' => 'array',
        'response' => 'array',
    ];

    public static function logRequest(Request $request, $response): void
    {
        $collection = config('requestLogConfig.collection_name');
        $connection = config('requestLogConfig.connection_name');
        $log                   = new RequestLogModel($connection, $collection);
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
