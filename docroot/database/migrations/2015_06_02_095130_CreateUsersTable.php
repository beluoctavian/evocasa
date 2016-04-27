<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * @    return void
     */
    public function up(){

        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('code');
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });

        $user = new App\User();
        $user->username = 'administrator';
        $user->name = 'administrator';
        $user->email = 'administrator@example.com';
        $user->code = 'AD';
        $user->password = Hash::make('administrator');
        $user->save();

    }

    public function down(){
        Schema::drop('users');
    }

}
