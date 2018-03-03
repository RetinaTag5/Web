<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		
		Schema::table('users', function($table){
			$table->string('hometown', 100)->after('name');
			$table->string('birthday', 100)->after('hometown');
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
		Schema::table('users', function($table) {
        $table->dropColumn('hometown');
		$table->dropColumn('birthday');
    });
    }
}
