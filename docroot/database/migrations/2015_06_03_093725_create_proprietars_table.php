<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProprietarsTable extends Migration {

	public function up()
	{
		Schema::create('proprietars', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('id_anunt');
            $table->string('nume');
            $table->string('prenume');
            $table->string('telefon');
            $table->string('email');
            $table->string('adresa');
            $table->string('cadastru');
            $table->string('intabulare');
            $table->string('observatii');
            $table->string('certificat_energetic');
            $table->string('poze_map');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('proprietars');
	}

}
