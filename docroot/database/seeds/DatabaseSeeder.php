<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();
        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'username' => 'cosmin',
            'name' => 'Ionescu Isac Cosmin',
            'email' => 'cosmin@evocasainvest.ro',
            'password' =>Hash::make('000000'),
            'code' => 'IC'
        ]);
        User::create([
            'username' => 'gabriela',
            'name' => 'Agrapinei Gabriela',
            'email' => 'gabriela@evocasainvest.ro',
            'password' =>Hash::make('000000'),
            'code' => 'AG'
        ]);
    }

}
