<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Apartment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('apartment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('usable_area');
			$table->string('built_area');
			$table->string('partitioning');
			$table->string('comfort');
			$table->string('floor');
			$table->string('built_year');
			$table->string('bathrooms');
			$table->string('obs_bathrooms');
			$table->string('sanitary');
			$table->string('obs_sanitary');
			$table->string('balconies');
			$table->string('obs_balconies');
			$table->string('parking');
			$table->string('obs_parking');
			$table->string('storeroom');
			$table->string('obs_storeroom');
			$table->string('garage');
			$table->string('obs_garage');
			$table->integer('advert_id');
			$table->foreign('advert_id');
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
		Schema::table('apartment', function(Blueprint $table)
		{
			//
		});
	}

}
