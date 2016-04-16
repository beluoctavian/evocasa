<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Improvements extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('improvements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('improvements');
			$table->integer('parent_id');
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
		Schema::table('improvements', function(Blueprint $table)
		{
			//
		});
	}

}
