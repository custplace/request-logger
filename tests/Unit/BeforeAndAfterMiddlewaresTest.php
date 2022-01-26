<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Http\Request;
use Custplace\requestLogger\Http\Middleware\RequestLogAfterMiddleware;
use Custplace\requestLogger\Http\Middleware\RequestLogBeforeMiddleware;
use Custplace\requestLogger\Tests\TestCase;

class BeforeAndAfterMiddlewaresTest extends TestCase
{
    /** @test */
    function it_capitalizes_the_request_title()
    {
        // create new request
        $request = new Request();

        //put the created request under the two middlewares below
        (new RequestLogAfterMiddleware())->handle($request);
        (new RequestLogAfterMiddleware())->handle($request, function ($request) {
            $this->assertContains($request, $adUnitArr);
        });
    }
}