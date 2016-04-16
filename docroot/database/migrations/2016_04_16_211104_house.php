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
		Schema::table('house', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('land_area');
			$table->string('street_opening');
			$table->string('footprint');
			$table->string('total_area');
			$table->string('level_area');
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
