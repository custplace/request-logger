<?php

namespace Custplace\requestLogger\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RequestLog extends Model
{
    use HasFactory;

    protected $casts = [
        'headers' => 'array',
        'request' => 'array',
        'response' => 'array',
    ];

    protected static function newFactory()
    {
        return \Custplace\requestLogger\Database\Factories\requestLogFactory::new();
    }

    public static function logRequest(Request $request, $response)
    {
        $connection = config('requestLogConfig.connection_name');
        $collection = config('requestLogConfig.collection_name');

        $log                   = new RequestLog();
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

        return $log->id;
    }
}
