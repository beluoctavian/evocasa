<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Input;
use File;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller {

	public function index() {
        $anunts = DB::table('anunts')
            ->where('first_page','=','1')
            ->where('status', 'NOT LIKE', '%inactiv%')
            ->orderBy('created_at', 'desc')->get();
        $page = Input::get('page');
        $orase = array_map('ucwords',array_unique(array_map('strtolower', DB::table('anunts')->lists('oras'))));
        sort($orase);
        $zone = array_map('ucwords',array_unique(array_map('strtolower', DB::table('anunts')->lists('zona'))));
        sort($zone);
        $cartiere = array_map('ucwords',array_unique(array_map('strtolower', DB::table('anunts')->lists('cartier'))));
        sort($cartiere);
        $compartimentari = array_map('ucwords',array_unique(array_map('strtolower', DB::table('imobils')->lists('compartimentare'))));
        return view('pages.index')->with('anunts',$anunts)->with('orase',$orase)->with('zone',$zone)->with('cartiere',$cartiere)->with('compartimentari',$compartimentari)->with('page',$page);
    }
	public function anunturi() {
        $gets = Input::get();
        $telefon_proprietar = isset($gets["telefon_proprietar"]) ? $gets["telefon_proprietar"] : null;
        $status = isset($gets["status"]) ? $gets["status"] : null;
        $cuvinte_cheie = isset($gets["cuvinte_cheie"]) ? strtolower($gets["cuvinte_cheie"]) : null;
        $id_anunt = isset($gets["id_anunt"]) ? strtolower($gets["id_anunt"]) : null;
        $pret_minim = isset($gets["pret_minim"]) ? $gets["pret_minim"] : 0;
        $pret_maxim = isset($gets["pret_maxim"]) ? $gets["pret_maxim"] : 2000000;
        $numar_camere = isset($gets["numar_camere"]) ? $gets["numar_camere"] : "1 2 3 4 5";
        $numar_camere = explode(" ",$numar_camere);
        array_push($numar_camere, "100", "101", "102", "103"); //random numbers
        $etaj_minim = isset($gets["etaj_minim"]) ? $gets["etaj_minim"] : 0;
        $etaj_minim = (strtolower($etaj_minim) == "p" || strtolower($etaj_minim) == "parter" || strtolower($etaj_minim) == "demisol" || strtolower($etaj_minim) == "d") ? 0 : $etaj_minim;
        $etaj_maxim = isset($gets["etaj_maxim"]) ? $gets["etaj_maxim"] : 2000000;
        $compartimentare = isset($gets["compartimentare"]) ? $gets["compartimentare"] : null;
        $an_constructie_minim = isset($gets["an_constructie_minim"]) ? $gets["an_constructie_minim"] : 0;
        $an_constructie_maxim = isset($gets["an_constructie_maxim"]) ? $gets["an_constructie_maxim"] : 2000000;
        $suprafata_minima = isset($gets["suprafata_minima"]) ? $gets["suprafata_minima"] : 0;
        $suprafata_maxima = isset($gets["suprafata_maxima"]) ? $gets["suprafata_maxima"] : 2000000;
        $oras = isset($gets["oras"]) ? $gets["oras"] : null;
        $cartier = isset($gets["cartier"]) ? $gets["cartier"] : null;
        $zona = isset($gets["zona"]) ? $gets["zona"] : null;
        $sortare = (isset($gets["sort"]) && $gets["sort"] == "pret") ? $gets["sort"] : "created_at";
        if($sortare == "created_at")
            $tip_sortare = "desc";
        else
            $tip_sortare = isset($gets["tip_sortare"]) ? $gets["tip_sortare"] : "asc";
        $statusQuery = "status NOT LIKE '%inactiv%'"; //do not show inactive items
        if($status == 'activ')
            $statusQuery = "status NOT LIKE '%inactiv%'";
        if($status == 'inactiv')
            $statusQuery = "status LIKE '%inactiv%'";
        $anunts = DB::table('anunts')
            ->join('imobils', 'imobils.id_anunt', '=', 'anunts.id')
            ->join('proprietars', 'proprietars.id_anunt', '=', 'anunts.id')
            ->where(strtolower('titlu'), 'LIKE', '%'.$cuvinte_cheie.'%')
            ->whereRaw($statusQuery . '')
            ->where('proprietars.telefon', 'LIKE', '%'.$telefon_proprietar.'%')
            ->whereRaw("(pret >= " . $pret_minim . " OR pret = '')")
            ->whereRaw("(pret <= " . $pret_maxim . " OR pret = '')")
            ->whereRAW("nr_camere IN ('" . $numar_camere[0] ."','" . $numar_camere[1] ."','" . $numar_camere[2] ."','" . $numar_camere[3] ."')")
            ->whereRaw("(LOWER(anunts.oras) LIKE '%" . strtolower($oras) . "%')")
            ->whereRaw("(LOWER(anunts.cartier) LIKE '%" . strtolower($cartier) . "%')")
            ->whereRaw("(LOWER(anunts.zona) LIKE '%" . strtolower($zona) . "%')")
            ->whereRaw("(SUBSTRING_INDEX(imobils.etaj,'/',1) >= " . $etaj_minim . " OR imobils.etaj = '')")
            ->whereRaw("(SUBSTRING_INDEX(imobils.etaj,'/',1) <= " . $etaj_maxim . " OR imobils.etaj = '')")
            ->whereRaw("(imobils.an_constructie >= " . $an_constructie_minim . " OR imobils.an_constructie = '')")
            ->whereRaw("(imobils.an_constructie <= " . $an_constructie_maxim . " OR imobils.an_constructie = '')")
            ->whereRaw("(imobils.sc >= " . $suprafata_minima . " OR imobils.sc = '')")
            ->whereRaw("(imobils.sc <= " . $suprafata_maxima . " OR imobils.sc = '')");
        if($compartimentare) {
            $anunts->whereRaw("(LOWER(imobils.compartimentare) = '" . strtolower($compartimentare) . "')");
        }
        if( $id_anunt ){
            $anunts->where(strtolower('cod'), '=', $id_anunt);
        }
        $anunts = $anunts
            ->orderBy('anunts.' . $sortare, $tip_sortare)
            ->select('anunts.*')
            ->get();
        $orase = array_map('ucwords',array_unique(array_map('strtolower', DB::table('anunts')->lists('oras'))));
        sort($orase);
        $zone = array_map('ucwords',array_unique(array_map('strtolower', DB::table('anunts')->lists('zona'))));
        sort($zone);
        $cartiere = array_map('ucwords',array_unique(array_map('strtolower', DB::table('anunts')->lists('cartier'))));
        sort($cartiere);
        $compartimentari = array_map('ucwords',array_unique(array_map('strtolower', DB::table('imobils')->lists('compartimentare'))));
        $page = Input::get('page');
        if(!$page || $page < 1){
            $page = 1;
        }
        return view('pages.anunturi')->with('anunts',$anunts)->with('orase',$orase)->with('zone',$zone)->with('cartiere',$cartiere)->with('compartimentari',$compartimentari)->with('page',$page);
    }
    public function detalii($id) {
        try {
            $anunt = DB::table('anunts')->where('id','=',$id)->first();
            $imobil = DB::table('imobils')->where('id_anunt','=',$id)->first();
            $imbunat = DB::table('imbunats')->where('id_anunt','=',$id)->first();
            $proprietar = DB::table('proprietars')->where('id_anunt','=',$id)->first();
            $similare = DB::table('anunts')->where('cartier', 'LIKE', '%'.$anunt->cartier.'%')->where('nr_camere', '=', $anunt->nr_camere)->where('id', '!=', $anunt->id)->take(2)->get();
        }catch(\Exception $e){
            return abort('404');
        }
        if(File::exists('uploaded-images/anunt_' . $id . '/')){
            $files = File::allFiles('uploaded-images/anunt_' . $id . '/');
            if(count($files)){
                sort($files);
                return view('pages.detalii')->with('anunt',$anunt)->with('imobil',$imobil)->with('imbunat',$imbunat)->with('proprietar',$proprietar)->with('similare',$similare)->with('files',$files);
            }
        }
        return view('pages.detalii')->with('anunt',$anunt)->with('imobil',$imobil)->with('imbunat',$imbunat)->with('proprietar',$proprietar)->with('similare',$similare);
    }
    public function despreNoi() {
        return view('pages.desprenoi');
    }
    public function servicii() {
        return view('pages.servicii');
    }
    public function contact() {
        return view('pages.contact');
    }
    public function postSearch(Request $request){
        $link = array();
        if($request->telefon_proprietar != "") array_push($link, 'telefon_proprietar=' . $request->telefon_proprietar);
        if($request->status != "") array_push($link, 'status=' . $request->status);
        if($request->cuvinte_cheie != "") array_push($link, 'cuvinte_cheie=' . $request->cuvinte_cheie);
        if($request->id_anunt != "") array_push($link, 'id_anunt=' . $request->id_anunt);
        if($request->pret_minim != "") array_push($link, 'pret_minim=' . $request->pret_minim);
        if($request->pret_maxim != "") array_push($link, 'pret_maxim=' . $request->pret_maxim);
        if($request->numar_camere != "") array_push($link, 'numar_camere=' . $request->numar_camere);
        if($request->etaj_minim != "") array_push($link, 'etaj_minim=' . $request->etaj_minim);
        if($request->etaj_maxim != "") array_push($link, 'etaj_maxim=' . $request->etaj_maxim);
        if($request->compartimentare != "") array_push($link, 'compartimentare=' . $request->compartimentare);
        if($request->an_constructie_minim != "") array_push($link, 'an_constructie_minim=' . $request->an_constructie_minim);
        if($request->an_constructie_maxim != "") array_push($link, 'an_constructie_maxim=' . $request->an_constructie_maxim);
        if($request->suprafata_minima != "") array_push($link, 'suprafata_minima=' . $request->suprafata_minima);
        if($request->suprafata_maxima != "") array_push($link, 'suprafata_maxima=' . $request->suprafata_maxima);
        if($request->oras != "") array_push($link, 'oras=' . $request->oras);
        if($request->cartier != "") array_push($link, 'cartier=' . $request->cartier);
        if($request->zona != "") array_push($link, 'zona=' . $request->zona);
        $link_final = '';
        foreach($link as $linkitem){
            if($link_final != '')
                $link_final = $link_final . '&' . $linkitem;
            else
                $link_final = '?' . $linkitem;
        }
        $link_final = $link_final . '#anunturi';
        return redirect('anunturi' . $link_final);
    }
}