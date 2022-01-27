<?php

namespace Custplace\requestLogger\Tests;

use Custplace\requestLogger\Providers\requestLogProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    // additional setup
  }

  protected function getPackageProviders($app)
  {
    return [
      requestLogProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    
  }
}