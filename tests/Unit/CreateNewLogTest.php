<?php

namespace Custplace\requestLogger\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Custplace\requestLogger\Tests\TestCase;
use Custplace\requestLogger\Tests\Models\requestLogTestModel;

class CreateNewLogTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function a_log_is_created()
  {
    $newLog = requestLogTestModel::factory()->create();
    $this->assertEquals('Fake Host', $newLog->app)
        ->assertNotEquals(requestLogTestModel::where('id', $newLog->id)->first(), null);
  }
}