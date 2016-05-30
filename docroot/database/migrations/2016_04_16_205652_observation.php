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
		Schema::create('observation', function(Blueprint $table)
		{
			$table->increments('id');
			$table->longText('text');
			$table->integer('owner_id')->unsigned();
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
