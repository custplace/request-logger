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
    $newLog = RequestLog::factory()->create([
        'app'              => 'Fake Host',
        'path'            =>  'Fake Path',
        'headers'         =>  'Fake headers',
        'method'           => 'Fake method',
        'request'          => 'Fake request',
        'response_code'    => 'Fake response code',
        'response_content' => 'Fake content',
        'duration'         => 'Fake duration',
        'ip'               => 'Fake ip'
    ]);
    $this->assertEquals('Fake Host', $newLog->app)
        ->assertNotEquals(RequestLog::where('id', $newLog->id)->first(), null);
  }
}