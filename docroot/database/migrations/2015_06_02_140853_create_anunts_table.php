<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnuntsTable extends Migration {

	public function up()
	{
		Schema::create('anunts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('titlu');
            $table->string('tip');
            $table->string('categorie');
            $table->integer('nr_camere');
            $table->string('oras');
            $table->string('cartier');
            $table->string('zona');
            $table->integer('pret');
            $table->integer('pret_vechi');
            $table->string('cod');
            $table->string('descriere');
            $table->string('status');
            $table->integer('first_page');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('anunts');
	}

}
