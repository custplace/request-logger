<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Custplace\requestLogger\Tests\TestCase;
use Custplace\requestLogger\Models\RequestLog;

class CreateNewLogTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function a_log_has_a_title()
  {
    $newLog = RequestLog::factory()->create();
    $this->assertEquals('Fake Host', $newLog->app)
        ->assertNotEquals(RequestLog::where('id', $newLog->id)->first(), null);
  }
}