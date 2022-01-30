<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Http\Request;
use Custplace\requestLogger\Http\Middleware\requestLogTestmiddleware;
use Custplace\requestLogger\Tests\TestCase;

class requestLogTest extends TestCase
{
    /** @test */
    function it_tests_middlewares()
    {
        // Given we have a request
        $request = new Request();
        $response = (new requestLogTestmiddleware())->handle($request, function ($request) { });
        dd($response);

        $this->assertStringContainsString('Hello World', $response);
    }
}