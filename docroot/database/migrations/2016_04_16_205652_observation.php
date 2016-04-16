<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Observation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('observation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('text');
			$table->integer('owner_id');
			$table->foreign('owner_id')
				->references('id')
				->on('owner')
				->onDelete('cascade');
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
		Schema::drop('observation');
	}

}
