<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Custplace\requestLogger\Http\Middleware\RequestLogAfterMiddlewareTest;
use Custplace\requestLogger\Http\Middleware\RequestLogBeforeMiddleware;
use Custplace\requestLogger\Tests\TestCase;
use Custplace\requestLogger\Models\RequestLogTest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BeforeAndAfterMiddlewaresTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_test_middlewares_effects()
    {
        $request = Request::create('/test', 'GET');
        (new RequestLogBeforeMiddleware())->handle($request, function($request) {});
        $response = (new RequestLogAfterMiddlewareTest())->handle(
            $request,
            fn() => new Response()
        );
        $this->assertNotEquals(RequestLogTest::where('id', $response->id)->first(), null);
    }
}