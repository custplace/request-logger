<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Custplace\requestLogger\Tests\TestCase;
use Custplace\requestLogger\Tests\Models\RequestLog;

class CreateNewLogTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function a_log_is_created()
  {
    $newLog = RequestLog::factory()->create();
    $this->assertEquals('Fake Host', $newLog->app)
        ->assertNotEquals(RequestLog::where('id', $newLog->id)->first(), null);
  }
}