<?php
use App\User;

$user = new User();
$user->password = \Hash::make('admin');
$user->username = 'admin';
$user->save();
