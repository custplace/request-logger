<?php

use Illuminate\Support\Facades\Route;
use Custplace\requestLogger\Models\RequestLog;

Route::middleware('api')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('test', function (\Illuminate\Http\Request $request) {
            return response()->json([
                'msg' => 'this is a test'
            ]);
        });
    });
});