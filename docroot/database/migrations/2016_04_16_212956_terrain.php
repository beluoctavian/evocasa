<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Terrain extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terrain', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('total_area');
			$table->integer('street_opening');
			$table->integer('depth');
			$table->integer('access_width');
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
		Schema::drop('terrain');
	}

}
