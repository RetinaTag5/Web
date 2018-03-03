<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Friendship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('friendship',function(Blueprint $table){
			$table->increments('friendshipId');
			$table->integer('user_r');
			$table->integer('user_c');
			$table->enum('relation', array(0, 1, 2) ); // 0:Request 1:Friend 2:No-friend
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::drop('friendship');
    }
}
