<?php namespace App\Http\Controllers;

use App\Advert;
use App\Apartment;
use App\Area;
use App\Http\Requests;
use App\Neighborhood;
use App\StatusType;
use App\Status;
use Illuminate\Http\Request;
use Input;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PagesController extends Controller {

	public function index(Request $request)
    {
        $recommended_id = StatusType::where('type', 'recomandat')->first()->id;
        $ids = Status::where('type_id', $recommended_id)->lists('advert_id');
        $ids = array_unique($ids);

        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $collection = new Collection($ids);
        $currentPageSearchResults = $collection->slice(($currentPage-1) * $perPage, $perPage)->all();
        foreach ($currentPageSearchResults as &$item) {
            $item = AdvertController::getEntityDetails($item);
        }

        $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage, $currentPage, [
          'path'  => $request->url(),
          'query' => $request->query(),
        ]);

        return view('pages.index')->with('items', $paginatedSearchResults);
    }

    public function detalii($id)
    {
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

    public function despreNoi()
    {
        return view('pages.desprenoi');
    }

    public function servicii()
    {
        return view('pages.servicii');
    }

    public function contact()
    {
        return view('pages.contact');
    }
    public function postSearch(Request $request){
//        $link = array();
        $key_words = Input::get('cuvinte_cheie');
        $advert_id = Input::get('id_anunt');
        $min_price = Input::get('pret_minim');
        $max_price = Input::get('pret_maxim');
        $min_year = Input::get('an_constructie_minim');
        $max_year = Input::get('an_constructie_maxim');
        $no_rooms = Input::get('numar_camere');
        $min_floor = Input::get('etaj_minim');
        $max_floor = Input::get('etaj_maxim');
        $min_surface = Input::get('suprafata_minima');
        $max_surface = Input::get('suprafata_maxima');
        $partitioning = Input::get('compartimentare');
        $neighborhood = Input::get('cartier');
        $phone = Input::get('phone');
        $area = Input::get('zona');
        $sort_after = Input::get('sortare');

        // house properties

        $min_total_area = Input::get('min_total_area');
        $max_total_area = Input::get('max_total_area');

        //terrain properties + total area

        $type = StatusType::find(Input::get('status'));
        $entity_type = Input::get('type');

        $inactive_status_id = StatusType::where('title', 'Inactiv')->first();

        $type_id = $type == null ? null : $type->id;
        if($entity_type == 'terrain'){

            $adverts = Advert::whereHas('terrain', function($query)
            use($min_total_area, $max_total_area) {
                if($min_total_area)
                {
                    $query->where('total_area', '>=', $min_total_area);
                }
                if($max_total_area)
                {
                    $query->where('total_area', '<=', $max_total_area);
                }
            });
        }
        else
            if($entity_type == 'house')
            {
                $adverts = Advert::whereHas('house', function($query)
                use($min_year, $max_year, $max_total_area, $min_total_area) {
                    if($min_year)
                    {
                        $query->where('built_year', '>=', $min_year);
                    }
                    if($max_year)
                    {
                        $query->where('built_year', '<=', $max_year);
                    }

                    if($min_total_area)
                    {
                        $query->where('total_area', '>=', $min_total_area);
                    }
                    if($max_total_area)
                    {
                        $query->where('total_area', '<=', $max_total_area);
                    }
                });
            }
            else{
                $adverts = Advert::whereHas('apartment', function($query)
                use($min_year, $max_year, $min_floor, $max_floor, $min_surface, $max_surface, $partitioning) {
                    if($min_year)
                    {
                        $query->where('built_year', '>=', $min_year);
                    }
                    if($max_year)
                    {
                        $query->where('built_year', '<=', $max_year);
                    }
                    if($max_floor)
                    {
                        $query->where('floor', '<=', substr($max_floor,0,1));
                    }
                    if($min_floor)
                    {
                        $query->where('floor', '>=', substr($min_floor,0,1));
                    }
                    if($min_surface)
                    {
                        $query->where('built_area', '>=', $min_surface);
                    }
                    if($max_surface)
                    {
                        $query->where('built_area', '<=', $max_surface);
                    }
                    if($partitioning)
                    {
                        $query->where('partitioning', $partitioning);
                    }
                });

            }

        if($phone)
        {
            $adverts ->whereHas('owner', function ($query) use ($phone) {
                $query->where('phone', 'like', '%' . $phone . '%');
            });
        };


        if($neighborhood)
        {
            $adverts->whereHas('neighborhood', function($query) use ($neighborhood) {
                $query->where('name', 'like', '%'.$neighborhood.'%');
            });
        }

        if($area)
        {
            $adverts->whereHas('area', function ($query) use ($area) {
                $query->where('name', 'like', '%'.$area.'%');
            });
        }


        if($type)
        {
            $adverts->whereHas('status', function ($query) use ($type_id) {
                $query->where('type_id', $type_id);
            });
        }
        
        if($min_price)
        {
            $adverts->where('price', '>=', $min_price);
        }

        if($max_price)
        {
            $adverts->where('price', '<=', $max_price);
        }
        if($key_words)
        {
            $adverts->where('title', 'like', '%'.$key_words.'%');
        }
        if($entity_type == 'apartment' or $entity_type == 'house')
        {
            if($no_rooms)
            {
                $no_rooms = explode(' ', $no_rooms);
                $adverts->whereIn('no_rooms', $no_rooms);
            }
        }
        if($advert_id)
        {
            $adverts->where('id', Input::get('id_anunt'));
        }
        if($sort_after)
        {
            $adverts->orderBy('price', $sort_after);
        }

        $results  = $adverts->paginate(10);

        $partitions = array_unique(Apartment::all()->lists('partitioning'));

        $neighborhoods = Neighborhood::all();

        $areas = Area::all();

        $page = Input::get('page');
        if(!$page || $page < 1){
            $page = 1;
        }

        return view('pages.adverts')
            ->with('adverts',$results->appends(Input::except('page')))
            ->with('partitions', $partitions)
            ->with('neighborhoods', $neighborhoods)
            ->with('areas', $areas)
            ->with('type', $type)
            ->with('page', $page);
    }
}