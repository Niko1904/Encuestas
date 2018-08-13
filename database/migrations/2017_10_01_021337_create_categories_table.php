<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('timer_type')->nullable();
            $table->integer('hour')->nullable();
            $table->integer('minutes')->nullable();
            $table->integer('seconds')->nullable();
            $table->boolean('pausable')->default(1);
            $table->boolean('status')->default(1);
            $table->boolean('answer_required');
            $table->boolean('show_all_questions')->default(1);
            $table->integer('percentage_values')->nullable();
            $table->integer('answers_yes_or_not')->nullable();
            $table->integer('group_type')->nullable();

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
        Schema::dropIfExists('categories');
    }
}
