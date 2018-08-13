<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {                   
        Schema::create('resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('poll_id');
            $table->integer('total');
            $table->string('from');
            $table->string('to');
            $table->string('text');
            
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
        Schema::dropIfExists('resumes');
    }
}
