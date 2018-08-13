<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPollclosedToMasterAplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_aplications',function(Blueprint $table)
        {
           $table->boolean('poll_closed')->default(0)->after('poll_id');

        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_aplications',function(Blueprint $table)
        {
           $table->dropColumn('poll_closed');

        });
    }
}
