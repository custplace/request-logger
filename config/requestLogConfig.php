<?php

use Illuminate\Support\Str;

return [
    'dsn' => env('DB_URI', 'mongodb+srv://root:pass@cluster0.vvsik.mongodb.net/myFirstDatabase?retryWrites=true&w=majority'),
    'database' => 'cluster0',
];
