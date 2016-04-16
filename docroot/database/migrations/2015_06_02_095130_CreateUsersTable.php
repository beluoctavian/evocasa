<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    public function up(){
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('username');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('code');
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });

    }

    public function down(){
        Schema::drop('users');
    }

}
