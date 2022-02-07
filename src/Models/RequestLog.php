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

    protected $casts = [
        'headers'  => 'array',
        'request'  => 'array',
        'response' => 'array',
    ];

    function __construct(String $connection, String $collection) {
        $this->collection = $collection;
        $this->connection = $connection;
    }

    public static function logRequest(Request $request, $response): void
    {
        $connection = config('request-log.connection_name');
        $collection = config('request-log.collection_name');

        $log                   = new RequestLog($connection, $collection);

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
