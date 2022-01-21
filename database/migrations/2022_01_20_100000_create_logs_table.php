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
            $table->text('app',);          
            $table->text('path',);          
            $table->text('headers',);        
            $table->text('method',);    
            $table->text('request',);  
            $table->text('response_code',);
            $table->text('response_content',);
            $table->text('duration',);
            $table->text('ip',);
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