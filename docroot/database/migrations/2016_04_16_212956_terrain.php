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
		Schema::table('terrain', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('total_area');
			$table->string('street_opening');
			$table->string('depth');
			$table->string('access_width');
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
