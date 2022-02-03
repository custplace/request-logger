<?php

use Illuminate\Support\Str;

return [
    'enabled' => true,
    'connection_name' => 'mongodb',// driver name
    'collection_name' => 'requests_log',// table name
    'file_path' => storage_path('logs/requestLogger.log'),
    'uris_that_should_be_ignored' => [],
];
