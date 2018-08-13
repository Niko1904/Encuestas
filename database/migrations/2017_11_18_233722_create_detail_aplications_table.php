<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailAplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_aplications', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->integer('value')->default(0);
            $table->integer('answer_id');
            $table->integer('master_aplication_id');
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
        Schema::dropIfExists('detail_aplications');
    }
}
