<?php

namespace Custplace\requestLogger\Database\Factories;

use Custplace\requestLogger\Models\RequestLogTest;
use Illuminate\Database\Eloquent\Factories\Factory;

class requestLogFactory extends Factory
{
    protected $model = RequestLogTest::class;

    public function definition()
    {
        return [
            'title'     => $this->faker->words(3, true),
            'body'      => $this->faker->paragraph,
            'author_id' => 999,
            'app'              => 'Fake Host',
            'path'            =>  $this->faker->paragraph,
            'headers'         =>  $this->faker->paragraph,
            'method'           => $this->faker->words(3, true),
            'request'          => $this->faker->paragraph,
            'response_code'    => $this->faker->paragraph,
            'response_content' => $this->faker->paragraph,
            'duration'         => '0.124564654',
            'ip'               => '192.168.1.1'
        ];        
    }
}