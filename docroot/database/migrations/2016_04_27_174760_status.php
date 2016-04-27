<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Status extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('status', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('type_id')->unsigned();
			$table->dateTime('date');
			$table->integer('advert_id')->unsigned();
			$table->foreign('type_id')
				->references('id')
				->on('status_type');
			$table->foreign('advert_id')
				->references('id')
				->on('advert');
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
		Schema::drop('status');
	}

}
