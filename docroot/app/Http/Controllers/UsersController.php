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

	public function viewAdauga(){
        if(Auth::guest())
            return redirect('/');
        return view('user.create');
    }

    public function postAdauga(Request $request){

        $anunt = Anunt::create([
            'titlu' => $request->titlu,
            'tip' => $request->tip,
            'categorie' => $request->categorie,
            'nr_camere' => $request->nr_camere,
            'oras' => $request->oras,
            'cartier' => $request->cartier,
            'zona' => $request->zona,
            'pret' => $request->pret,
            'pret_vechi' => $request->pret_vechi,
            'descriere' => $request->descriere,
            'first_page' => $request->first_page ? 1 : 0
        ]);
        $anunt->cod = Auth::user()->code . '_' . $anunt->id;
        $anunt->save();

        $imobil = Imobil::create([
            'su' => $request->su,
            'sc' => $request->sc,
            'compartimentare' => $request->compartimentare,
            'confort' => $request->confort,
            'etaj' => $request->etaj,
            'numbar_bai' => $request->numar_bai,
            'obs_numbar_bai' => $request->obs_numar_bai,
            'numbar_bai_serviciu' => $request->numar_bai_serviciu,
            'obs_numbar_bai_serviciu' => $request->obs_numar_bai_serviciu,
            'numbar_balcoane' => $request->numar_balcoane,
            'obs_numbar_balcoane' => $request->obs_numar_balcoane,
            'an_constructie' => $request->an_constructie,
            'loc_parcare' => $request->loc_parcare,
            'obs_loc_parcare' => $request->obs_loc_parcare,
            'boxa' => $request->boxa,
            'obs_boxa' => $request->obs_boxa,
            'garaj' => $request->garaj,
            'obs_garaj' => $request->obs_garaj
        ]);
        $imobil->id_anunt = $anunt->id;
        $imobil->save();

        $imbunat = Imbunat::create([
            'gresie' => $request->gresie ? 1 : 0,
            'faianta' => $request->faianta ? 1 : 0,
            'termopan' => $request->termopan ? 1 : 0,
            'aer' => $request->aer ? 1 : 0,
            'parchet' => $request->parchet ? 1 : 0,
            'instalatie_sanitara' => $request->instalatie_sanitara ? 1 : 0,
            'instalatie_electrica' => $request->instalatie_electrica ? 1 : 0,
            'contor_gaze' => $request->contor_gaze ? 1 : 0,
            'centrala' => $request->centrala ? 1 : 0,
            'mobilier' => $request->mobilier ? 1 : 0,
            'usa_metalica' => $request->usa_metalica ? 1 : 0,
            'usi_interioare' => $request->usi_interioare ? 1 : 0,
            'fara_imbunatatiri' => $request->fara_imbunatatiri ? 1 : 0
        ]);
        $imbunat->id_anunt = $anunt->id;
        $imbunat->save();

        $proprietar = Proprietar::create([
            'nume' => $request->nume_proprietar,
            'prenume' => $request->prenume_proprietar,
            'email' => $request->email_proprietar,
            'adresa' => $request->adresa_proprietar,
            'cadastru' => $request->cadastru_proprietar,
            'intabulare' => $request->intabulare_proprietar,
            'observatii' => $request->observatii_proprietar,
            'certificat_energetic' => $request->certificat_energetic_proprietar,
            'poze_map' => $request->poze_map_proprietar ? 1 : 0
        ]);
        $proprietar->id_anunt = $anunt->id;
        $telefon = '';
        foreach($request->telefon_proprietar as $tel){
            $telefon = $telefon . $tel . ',';
        }
        $proprietar->telefon = $telefon;
        $proprietar->save();

        return redirect('editeaza-anunt/' . $anunt->id)->with('successAdd',1);
    }
    public function getEditeaza($id){
        if(Auth::guest())
            return redirect('/');
        try {
            $anunt = DB::table('anunts')->where('id','=',$id)->first();
            $imobil = DB::table('imobils')->where('id_anunt','=',$id)->first();
            $imbunat = DB::table('imbunats')->where('id_anunt','=',$id)->first();
            $proprietar = DB::table('proprietars')->where('id_anunt','=',$id)->first();
        }catch(\Exception $e){
            return abort('404');
        }
        return view('user.edit')->with('anunt',$anunt)->with('imobil',$imobil)->with('imbunat',$imbunat)->with('proprietar',$proprietar);
    }
    public function postEditeaza(Request $request){
        if(Auth::guest())
            return redirect('/');
        $status = '';
        if($request->status){
            foreach($request->status as $stat){
                $status = $status . $stat . ',';
            }
        }
        DB::table('anunts')->where('id','=',$request->id)->update([
            'titlu' => $request->titlu,
            'tip' => $request->tip,
            'categorie' => $request->categorie,
            'nr_camere' => $request->nr_camere,
            'oras' => $request->oras,
            'cartier' => $request->cartier,
            'zona' => $request->zona,
            'pret' => $request->pret,
            'pret_vechi' => $request->pret_vechi,
            'descriere' => $request->descriere,
            'status' => $status,
            'first_page' => $request->first_page ? 1 : 0
        ]);

        DB::table('imobils')->where('id_anunt','=',$request->id)->update([
            'su' => $request->su,
            'sc' => $request->sc,
            'compartimentare' => $request->compartimentare,
            'confort' => $request->confort,
            'etaj' => $request->etaj,
            'numbar_bai' => $request->numar_bai,
            'obs_numbar_bai' => $request->obs_numar_bai,
            'numbar_bai_serviciu' => $request->numar_bai_serviciu,
            'obs_numbar_bai_serviciu' => $request->obs_numar_bai_serviciu,
            'numbar_balcoane' => $request->numar_balcoane,
            'obs_numbar_balcoane' => $request->obs_numar_balcoane,
            'an_constructie' => $request->an_constructie,
            'loc_parcare' => $request->loc_parcare,
            'obs_loc_parcare' => $request->obs_loc_parcare,
            'boxa' => $request->boxa,
            'obs_boxa' => $request->obs_boxa,
            'garaj' => $request->garaj,
            'obs_garaj' => $request->obs_garaj
        ]);

        DB::table('imbunats')->where('id_anunt','=',$request->id)->update([
            'gresie' => $request->gresie ? 1 : 0,
            'faianta' => $request->faianta ? 1 : 0,
            'termopan' => $request->termopan ? 1 : 0,
            'aer' => $request->aer ? 1 : 0,
            'parchet' => $request->parchet ? 1 : 0,
            'instalatie_sanitara' => $request->instalatie_sanitara ? 1 : 0,
            'instalatie_electrica' => $request->instalatie_electrica ? 1 : 0,
            'contor_gaze' => $request->contor_gaze ? 1 : 0,
            'centrala' => $request->centrala ? 1 : 0,
            'mobilier' => $request->mobilier ? 1 : 0,
            'usa_metalica' => $request->usa_metalica ? 1 : 0,
            'usi_interioare' => $request->usi_interioare ? 1 : 0,
            'fara_imbunatatiri' => $request->fara_imbunatatiri ? 1 : 0
        ]);

        $telefon = '';
        foreach($request->telefon_proprietar as $tel){
            if($tel != "")
                $telefon = $telefon . $tel . ',';
        }
        DB::table('proprietars')->where('id_anunt','=',$request->id)->update([
            'nume' => $request->nume_proprietar,
            'prenume' => $request->prenume_proprietar,
            'telefon' => $telefon,
            'email' => $request->email_proprietar,
            'adresa' => $request->adresa_proprietar,
            'cadastru' => $request->cadastru_proprietar,
            'intabulare' => $request->intabulare_proprietar,
            'observatii' => $request->observatii_proprietar,
            'certificat_energetic' => $request->certificat_energetic_proprietar,
            'poze_map' => $request->poze_map_proprietar ? 1 : 0,
            'bloc_reabilitat' => $request->bloc_reabilitat ? 1 : 0
        ]);

        $anunt = Anunt::find($request->id);
        $anunt->touch();
        return redirect('editeaza-anunt/' . $request->id)->with('success',1);
    }
    public function getUpload($id){
        if(Auth::guest())
            return redirect('/');
        try {
            $anunt = DB::table('anunts')->where('id','=',$id)->first();
            if(!File::exists('uploaded-images/anunt_' . $id . '/')){
                File::makeDirectory('uploaded-images/anunt_' . $id . '/', $mode = 0777, true, true);
            }
            $files = File::allFiles('uploaded-images/anunt_' . $id . '/');
            sort($files);
        }catch(\Exception $e){
            return abort('404');
        }
        return view('user.upload')->with('anunt',$anunt)->with('files',$files);
    }
    public function postUpload(Request $request){
        if(Auth::guest())
            return redirect('/');
        ini_set("memory_limit","256M");
        $id = $request->id;
        $destinationPath = 'uploaded-images/anunt_' . $id;
        $files = $request->file('files');
        if($files[0] === null){
            return redirect()->back()->withErrors('Nu ati selectat niciun fisier!');
        }
        if(!File::exists($destinationPath)){
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }
        $destinationPath = $destinationPath . '/';
        foreach($request->file('files') as $file){
            $im_path = $destinationPath . $file->getClientOriginalName();
            $file->move($destinationPath, $file->getClientOriginalName());
            $image = imagecreatefromstring(file_get_contents($im_path));
            $watermark = imagecreatefrompng('img/evocasa_logo_big.png');

            $image_width = imagesx($image);
            $image_height = imagesy($image);

            $watermark_width = imagesx($watermark);
            $watermark_height = imagesy($watermark);

            $new_watermark_width = $watermark_width;
            $new_watermark_height = $watermark_height;
            $diffwi = 0;
            $diffhe = 0;
            if($watermark_width > $image_width){
                $diffwi = $watermark_width - $image_width;
            }
            if($watermark_height > $image_height){
                $diffhe = $watermark_height - $image_height;
            }
            if($diffwi > $diffhe){
                $new_watermark_width -= $diffwi;
                $new_watermark_height -= $diffwi;
            } else {
                $new_watermark_width -= $diffhe;
                $new_watermark_height -= $diffhe;
            }
            imagecopyresized(
                $image,                                  // Destination image
                $watermark,                              // Source image
                $image_width/2 - $new_watermark_width/2,  // Destination X
                $image_height/2 - $new_watermark_height/2, // Destination Y
                0,                                       // Source X
                0,                                       // Source Y
                $new_watermark_width,                      // Destination W
                $new_watermark_height,                     // Destination H
                imagesx($watermark),                     // Source W
                imagesy($watermark)
            );                    // Source H
            imagepng($image,$im_path);
            imagedestroy($image);
        }
        return redirect('upload-images/' . $id)->with('success',1);
    }
    public function deleteImage(Request $request)
    {
        File::delete($request->filename);
        return redirect()->back()->with('successDelete', 1);
    }
    public function changeImageNumber(Request $request){
        $path = $request->path;
        $oldfilename = $filename = $request->filename;
        $number = $request->number;
        if($filename[2] == '_'){
            $filename = substr_replace($filename,$number,0,3);
        }else{
            $filename = substr_replace($filename,$number,0,0);
        }
        if ( ! File::move($path . $oldfilename, $path . $filename))
        {
            die("Couldn't rename file");
        }
        return redirect('upload-images/' . $request->anunt_id . '#images');
    }
    public function getPrinteaza($id){
        if(Auth::guest())
            return redirect('/');
        try {
            $anunt = DB::table('anunts')->where('id','=',$id)->first();
            $imobil = DB::table('imobils')->where('id_anunt','=',$id)->first();
            $imbunat = DB::table('imbunats')->where('id_anunt','=',$id)->first();
            $proprietar = DB::table('proprietars')->where('id_anunt','=',$id)->first();
        }catch(\Exception $e){
            return abort('404');
        }
        return view('user.print')->with('anunt',$anunt)->with('imobil',$imobil)->with('imbunat',$imbunat)->with('proprietar',$proprietar);
    }
    public function sterge(Request $request){
        if(Auth::guest())
            return redirect('/');
        DB::table('anunts')->where('id','=',$request->id)->delete();
        DB::table('imobils')->where('id_anunt','=',$request->id)->delete();
        DB::table('imbunats')->where('id_anunt','=',$request->id)->delete();
        return redirect('anunturi')->with('successDelete',1);
    }
    public function updateDate($id){
        $anunt = Anunt::find($id);
        $anunt->touch();
        return redirect(URL::previous() . '#advert-item-no-' . $id);
    }
    public function getSettings(){
        if(Auth::guest())
            return redirect('/');
        return view('user.settings');
    }
    public function postSettings(Request $request){
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
