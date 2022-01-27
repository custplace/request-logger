<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Http\Request;
use Custplace\requestLogger\Http\Middleware\RequestLogAfterMiddleware;
use Custplace\requestLogger\Http\Middleware\RequestLogBeforeMiddleware;
use Custplace\requestLogger\Tests\TestCase;
use Custplace\requestLogger\Models\RequestLog;

class BeforeAndAfterMiddlewaresTest extends TestCase
{
    /** @test */
    function it_test_middlewares_effects()
    {
        // create new request
        $request = new Request();

        //put the created request under the two middlewares below
        (new RequestLogAfterMiddleware())->handle($request);
        $response = (new RequestLogAfterMiddleware())->handle($request, function ($request) { });
        $this->assertNotEquals(RequestLog::where('id', $response->id)->first(), null);
    }
}