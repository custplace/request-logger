<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Http\Request;
use Custplace\requestLogger\Http\Middleware\requestLogTestmiddleware;
use Custplace\requestLogger\Tests\TestCase;

class requestLogTest extends TestCase
{
    /** @test */
    function it_checks_for_a_hello_word_in_response()
    {
        // Given we have a request
        $request = new Request();

        // when we pass the request to this middleware,
        // the response should contain 'Hello World'
        $response = (new requestLogTestmiddleware())->handle($request, function ($request) { });
        dd($response);

        $this->assertStringContainsString('Hello World', $response);
    }
}