<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_log', function (Blueprint $table) {
            $table->id();
            $table->string('app');
            $table->string('path');
            $table->longText('headers');
            $table->string('method');
            $table->longText('request')->nullable();
            $table->integer('response_code')->nullable();
            $table->longText('response_content')->nullable();
            $table->float('duration');
            $table->string('ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests_log');
    }
}