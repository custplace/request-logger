<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Custplace\requestLogger\Tests\TestCase;
use Custplace\requestLogger\Models\RequestLogTest;

class CreateNewLogTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function a_log_is_created()
  {
    $newLog = RequestLogTest::factory()->create();
    $this->assertEquals('Fake Host', $newLog->app)
        ->assertNotEquals(RequestLogTest::where('id', $newLog->id)->first(), null);
  }
}