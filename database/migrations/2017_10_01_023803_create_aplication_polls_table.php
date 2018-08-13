<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicationPollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplication_polls', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->integer('value');
            $table->integer('user_id');
            $table->integer('poll_id');
            $table->integer('answer_id');
            $table->integer('question_id');
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
        Schema::dropIfExists('aplication_polls');
    }
}
