<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImbunatsTable extends Migration {

	public function up()
	{
		Schema::create('imbunats', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('id_anunt');
            $table->integer('gresie');
            $table->integer('faianta');
            $table->integer('termopan');
            $table->integer('aer');
            $table->integer('parchet');
            $table->integer('instalatie_sanitara');
            $table->integer('instalatie_electrica');
            $table->integer('centrala');
            $table->integer('mobilier');
            $table->integer('usa_metalica');
            $table->integer('usi_interioare');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('imbunats');
	}

}
