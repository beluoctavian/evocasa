<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Owner extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('owner', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('phone');
			$table->string('email');
			$table->string('cadaster');
			$table->string('registrations');
			$table->string('energy_certificate');
			$table->string('urbanism_certificate');
			$table->boolean('map_pictures');
			$table->boolean('rehabilitated_block');
			$table->string('address');
			$table->integer('advert_id')->unsigned();
			$table->foreign('advert_id')
				->references('id')
				->on('advert')
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
		Schema::drop('owner');
	}

}
