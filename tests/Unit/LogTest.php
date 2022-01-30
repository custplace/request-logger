<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Http\Request;
use Custplace\requestLogger\Http\Middleware\requestLogTestmiddleware;
use Custplace\requestLogger\Http\Middleware\RequestLogBeforeMiddleware;
use Custplace\requestLogger\Tests\TestCase;
use Custplace\requestLogger\Models\RequestLogTestModel;

class LogTest extends TestCase
{
    /** @test */
    function it_tests_middlewares()
    {
        // Given we have a request
        $request = new Request();
        (new RequestLogBeforeMiddleware())->handle($request, function ($request) { });
        $response = (new requestLogTestmiddleware())->handle($request, function ($request) { });

        $this->assertNotEquals(RequestLogTestModel::where('id', $response->id)->first(), null);
    }
}