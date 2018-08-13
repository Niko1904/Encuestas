<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollUsersTable extends Migration
{
    
    public function up()
    {
        Schema::create('poll__users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poll_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('poll__users');
    }
}
