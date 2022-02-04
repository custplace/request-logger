<?php

return [
    /*
    / True or false
    */
    'enabled' => true,

    /*
    / Driver name
    / Only "mongodb" is supported
    */
    'connection_name' => 'mongodb',

    /*
    / Specify the collection name
    */
    'collection_name' => 'requests_log',

    /*
    / Spcify the path where the log file should be created
    */
    'file_path' => storage_path('logs/requestLogger.log'),

    /*
    / You can add URLS that you don't wanna log 
    */
    'ignored_urls' => [],
];
