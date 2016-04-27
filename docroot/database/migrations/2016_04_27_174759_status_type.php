<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusType extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('status_type', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type');
			$table->string('title');
			$table->timestamps();

		});
		$types = [
			'recomandat' => 'Recomandat',
			'telefon_dat' => 'Telefon dat',
			'nu_raspunde' => 'Nu raspunde',
			'telefon_inchis' => 'Telefon inchis',
			'nu_colaboreaza' => 'Nu colaboreaza',
			'retras' => 'Retras momentan',
			'inactiv' => 'Inactiv',
		];
		foreach ($types as $type => $title) {
			DB::table('status_type')->insert([
				'type' => $type,
				'title' => $title,
			]);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('status_type');
	}

}
