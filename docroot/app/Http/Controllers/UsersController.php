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
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $info_dirname = 'files/website/info/';
        if (!\File::exists($info_dirname)) {
            $create = \File::makeDirectory($info_dirname, $mode = 0777, true, true);
            if ($create === FALSE) {
                throw new \Exception("Could not create directory:{$info_dirname}");
            }
        }
        $files = \File::allFiles($info_dirname);
        usort($files, function ($a, $b) {
            return $a->getCTime() - $b->getCTime();
        });
        return view('user.settings')
          ->with('files', $files);
    }

    public function postUserSettings(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password,$user->password)){
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
        }
        else {
            return redirect()->back()->with('fail', 'Ati introdus gresit parola!');
        }
        return redirect()->back()->with('success', 'Modificarile au fost salvate.');
    }

    public function postWebsiteSettings(Request $request)
    {

        ini_set("memory_limit","256M");
        $destinationPath = 'files/website/info/';
        $files = $request->file('files');
        if ($files[0] !== null){
            foreach ($request->file('files') as $file) {
                /** @var UploadedFile $file */
                $file->move($destinationPath, $file->getClientOriginalName());
            }
        }
        return redirect()->back()->with('success', 'Modificarile au fost salvate.');
    }

    public function postDeleteFile(Request $request)
    {
        $success = \File::delete($request->get('file'));
        if ($success) {
            return redirect()->back()->with('success', 'Ati sters fisierul. cu succes');
        }
        else {
            return redirect()->back()->with('fail', 'Fisierul nu a putut fi sters.');
        }
    }
}
