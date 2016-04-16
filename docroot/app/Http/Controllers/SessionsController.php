<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Input;

class SessionsController extends Controller {

    public function create()
    {
        if(Auth::check()) return redirect('dashboard');
        return view('auth.login');
    }

    public function store()
    {
        if($try = Auth::attempt(Input::only('username', 'password'))) {
            return redirect('/');
        }
        return redirect('login')->withInput()->withErrors('Login-ul a esuat.');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->back();
    }

}
