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
            $table->string('phone');
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });

        $users = [
            [
                'username' => 'ysaccosmin@evocasainvest.ro',
                'name' => 'Ionescu Isac Cosmin',
                'email' => 'cosmin@evocasainvest.ro',
                'password' => '$2y$10$FMAifdEoPNlpuMFti38Yy.vWvMjPKj6ZoMJ6AjtuYuEZARYAgvwIW',
                'code' => 'IC',
            ],
            [
                'username' => 'a.gabriela@evocasainvest.ro',
                'name' => 'Agrapinei Gabriela',
                'email' => 'gabriela@evocasainvest.ro',
                'password' => '$2y$10$s7qwu/P5cnb1BE4X8YMwKu0Rehe/hByPc9Mk3oKnBh8T3UuNhhEca',
                'code' => 'AG',
            ],
            [
                'username' => 'administrator',
                'name' => 'administrator',
                'email' => 'administrator@evocasainvest.ro',
                'password' => '$2y$10$VQFqI47HvqMXpQBl0RjYSOkVzahyqYnbZ5YGJ7dVGBFjUI/TJKDpO',
                'code' => 'ADMIN',
            ],
        ];
        foreach ($users as $user) {
            $newUser = new App\User();
            $newUser->username = $user['username'];
            $newUser->name = $user['name'];
            $newUser->email = $user['email'];
            $newUser->code = $user['code'];
            $newUser->password = $user['password'];
            $newUser->save();
        }

    }

    public function down(){
        Schema::drop('users');
    }

}
