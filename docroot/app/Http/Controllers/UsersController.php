<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use DB;
use File;
use App\Anunt;
use App\Imobil;
use App\Imbunat;
use App\Proprietar;
use Hash;
use URL;

class UsersController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPrinteaza($id)
    {
        // TODO: Do we need this anymore?
        try {
            $anunt = DB::table('anunts')->where('id','=',$id)->first();
            $imobil = DB::table('imobils')->where('id_anunt','=',$id)->first();
            $imbunat = DB::table('imbunats')->where('id_anunt','=',$id)->first();
            $proprietar = DB::table('proprietars')->where('id_anunt','=',$id)->first();
        }
        catch(\Exception $e) {
            abort(404);
        }
        return view('user.print')->with('anunt',$anunt)->with('imobil',$imobil)->with('imbunat',$imbunat)->with('proprietar',$proprietar);
    }

    public function getSettings()
    {
        return view('user.settings');
    }

    public function postUserSettings(Request $request)
    {
        $user = Auth::user();
        if(Hash::check($request->password,$user->password)){
            if($request->newPassword){
                if(strlen($request->newPassword) < 6){
                    return redirect()->back()->with('smallpass',1);
                }
                if(strcmp($request->newPassword,$request->repeatNewPassword)){
                    return redirect()->back()->with('notmatch',1);
                }
                $user->password = Hash::make($request->newPassword);
            }
            $user->username = $request->username;
            $user->save();
        }else{
            return redirect()->back()->with('wrongpass',1);
        }
        return redirect()->back()->with('success',1);
    }
}
