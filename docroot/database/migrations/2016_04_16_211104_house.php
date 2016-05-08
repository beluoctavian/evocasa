<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class House extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('house', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('land_area');
			$table->integer('street_opening');
			$table->string('footprint');
			$table->integer('total_area');
			$table->integer('level_area');
			$table->string('height');
			$table->string('built_year');
			$table->string('bathrooms');
			$table->string('obs_bathrooms');
			$table->string('sanitary');
			$table->string('obs_sanitary');
			$table->string('balconies');
			$table->string('obs_balconies');
			$table->string('garage');
			$table->string('obs_garage');
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
		Schema::drop('house');
	}

}
