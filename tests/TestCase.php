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
    // perform environment setup
    include_once __DIR__ . '/../../database/migrations/create_logs_table.php';

    // run the up() method of that migration class
    (new \CreateLogsTable)->up();
    }
}