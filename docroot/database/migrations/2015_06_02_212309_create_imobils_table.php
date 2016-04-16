<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImobilsTable extends Migration {

	public function up()
	{
		Schema::create('imobils', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_anunt');
            $table->float('su');
            $table->float('sc');
            $table->string('compartimentare');
            $table->string('confort');
            $table->string('etaj');
            $table->string('numbar_bai');
            $table->string('numbar_bai_serviciu');
            $table->string('numbar_balcoane');
            $table->string('an_constructie');
            $table->string('loc_parcare');
            $table->string('boxa');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('imobils');
	}

}
