<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Advert extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advert', function(Blueprint $table) {
			$table->increments('id');
			$table->string('code');
			$table->string('title');
			$table->string('type');
			$table->string('no_rooms');
			$table->boolean('first_page');
			$table->float('price');
			$table->string('old_price');
			$table->string('description');
			$table->integer('neighborhood_id')->unsigned();
			$table->foreign('neighborhood_id')
				->references('id')
				->on('neighborhood');
			$table->integer('area_id')->unsigned();
			$table->foreign('area_id')
				->references('id')
				->on('area');
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
		Schema::drop('advert');
	}

}
