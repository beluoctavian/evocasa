<?php namespace App\Http\Controllers;

use App\Advert;
use App\Apartment;
use App\Area;
use App\House;
use App\Http\Requests;
use App\Neighborhood;
use App\StatusType;
use App\Status;
use \Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PagesController extends Controller {

    private function getInputDefaults($entity_type = 'apartament')
    {
        $db_type = $entity_type == 'apartament' ? 'apartment' : ($entity_type == 'casa' ? 'house' : 'terrain');
        $input_defaults = [
          'pret_minim' => \DB::table('advert')->where('type', $db_type)->min('price'),
          'pret_maxim' => \DB::table('advert')->where('type', $db_type)->max('price'),
        ];
        switch($entity_type) {
            case 'casa':
                $input_defaults['suprafata_minima'] = \DB::table('house')->min('land_area');
                $input_defaults['suprafata_maxima'] = \DB::table('house')->max('land_area');
                $input_defaults['an_constructie_minim'] = \DB::table('house')->where('built_year', '>', '0')->min('built_year');
                $input_defaults['an_constructie_maxim'] = \DB::table('house')->max('built_year');
                break;
            case 'teren':
                $input_defaults['suprafata_minima'] = \DB::table('terrain')->min('total_area');
                $input_defaults['suprafata_maxima'] = \DB::table('terrain')->max('total_area');
                break;
            default:
                $input_defaults['suprafata_minima'] = \DB::table('apartment')->min('built_area');
                $input_defaults['suprafata_maxima'] = \DB::table('apartment')->max('built_area');
                $input_defaults['an_constructie_minim'] = \DB::table('apartment')->where('built_year', '>', '0')->min('built_year');
                $input_defaults['an_constructie_maxim'] = \DB::table('apartment')->max('built_year');
        }
        foreach ($input_defaults as $key => $value) {
            if ($value == '') {
                $input_defaults[$key] = '0';
            }
        }
        return $input_defaults;
    }

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

        return view('pages.index')
          ->with('items', $paginatedSearchResults)
          ->with('input_defaults', $this->getInputDefaults());
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
        $no_rooms[] = Input::get('numar_camere');
        $floor[] = Input::get('etaj');
        $min_surface = Input::get('suprafata_minima');
        $max_surface = Input::get('suprafata_maxima');
        $partitioning[] = Input::get('compartimentare');
        $neighborhood[] = Input::get('cartier');
        $phone = Input::get('telefon_proprietar');
        $area[] = Input::get('zona');
        $sort_after = Input::get('sortare');
        // house properties

        $min_total_area = Input::get('suprafata_minima');
        $max_total_area = Input::get('suprafata_maxima');

        //terrain properties + total area

        $status = Input::get('status') ? Input::get('status') : 'activ';
        if(Auth::guest())
        {
            $status = 'activ';
        }

        $entity_type = Input::get('tip') ? Input::get('tip') : 'apartament';

        if($entity_type == 'teren'){

            $adverts = Advert::whereHas('terrain', function($query)
            use($min_total_area, $max_total_area) {
                if($min_total_area)
                {
                    $query->where('total_area', '>=', (int)$min_total_area);
                }
                if($max_total_area)
                {
                    $query->where('total_area', '<=', (int)$max_total_area);
                }
            });
        }
        else
            if($entity_type == 'casa')
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
                        $query->where('land_area', '>=', $min_total_area);
                    }
                    if($max_total_area)
                    {
                        $query->where('land_area', '<=', $max_total_area);
                    }
                });
            }
            else{

                $adverts = Advert::whereHas('apartment', function($query)
                use($min_year, $max_year,$floor , $min_surface, $max_surface, $partitioning) {
                    if($min_year)
                    {
                        $query->where('built_year', '>=', $min_year);
                    }
                    if($max_year)
                    {
                        $query->where('built_year', '<=', $max_year);
                    }
                    if($floor[0])
                    {
                        $etaj = "( ";
                        foreach($floor[0] as $et)
                            if($et == 'parter' or $et == 'demisol')
                                continue;
                        else
                            $etaj .= $et . ', ';

                        if(in_array('parter', $floor[0]))
                            $etaj .= "'P' ) ";
                        else
                            if(in_array('parter', $floor[0]))
                                $etaj .= "D' ) ";
                            else
                                $etaj .= "'-1' ) ";

                        $query->whereRaw('substring_index(apartment.floor, \'/\', 1)  in '. $etaj);

                    }
                    if($min_surface)
                    {
                        $query->where('built_area', '>=', $min_surface);
                    }
                    if($max_surface)
                    {
                        $query->where('built_area', '<=', $max_surface);
                    }
                    if($partitioning[0])
                    {
                        $query->whereIn('partitioning', $partitioning[0]);
                    }
                });

            }

        if($phone)
        {
            $adverts ->whereHas('owner', function ($query) use ($phone) {
                $query->where('owner.phone', 'like', '%' . $phone . '%');
            });
        };


        if($neighborhood[0])
        {
            $adverts->whereHas('neighborhood', function($query) use ($neighborhood) {
                $query->whereIn('name',$neighborhood[0]);
            });
        }

        if($area[0])
        {
            $adverts->whereHas('area', function ($query) use ($area) {
                $query->whereIn('name', $area[0]);
            });
        }


        if($min_price !== NULL and $min_price != '')
        {
            $adverts->where('price', '>=', $min_price);
        }

        if($max_price !== NULL and $max_price != '')
        {
            $adverts->where('price', '<=', $max_price);
        }

        if($key_words)
        {
            $adverts->where('title', 'like', '%'.$key_words.'%');
        }

        if($entity_type == 'apartament' or $entity_type == 'casa') {
            if (count($no_rooms[0]  ) > 0) {
                if (in_array(4, $no_rooms[0])) {
                    for ($value = 5; $value <= 20; $value++)
                        $no_rooms[] = $value;
                }
                $adverts->whereIn('no_rooms', $no_rooms[0]);
            }
        }
        if($advert_id)
        {
            $adverts->where('code', Input::get('id_anunt'));
        }


        $inactive_status_id = StatusType::where('title', 'Inactiv')->first()->id;

        if($status == 'inactiv')
        {
            $adverts->whereHas('status', function($query) use ($inactive_status_id){
                $query->where('type_id', $inactive_status_id);
            });
        }
        if($sort_after)
        {
            $criteriul = explode('_', $sort_after)[0];
            if($criteriul == 'date')
            {
                $criteriul = 'updated_at';
            }
            $ordinea = explode('_', $sort_after)[1];
            $adverts->orderBy($criteriul, $ordinea);
        }

        $results = [];
        if($status == 'activ')
        {
            foreach($adverts->get() as $advert)
            {
                $flag = true;
                    if($advert->status)
                {
                    foreach($advert->status as $status)
                        if($status->type_id == $inactive_status_id)
                        {
                            $flag = false;
                        }
                }
                if($flag == true)
                    $results[] = $advert->id;
            }
            if($sort_after)
            {
                $criteriul = explode('_', $sort_after)[0];
                if($criteriul == 'date')
                {
                    $criteriul = 'updated_at';
                }
                $ordinea = explode('_', $sort_after)[1];
                $results  = Advert::whereIn('id', $results)->orderBy($criteriul, $ordinea)->paginate(10);
            }
            else
            {
                $results  = Advert::whereIn('id', $results)->paginate(10);
            }
        }
        else
        {
            $results  = $adverts->paginate(10);
        }



        $partitions = array_unique(Apartment::all()->lists('partitioning'));

        $neighborhoods = Neighborhood::all();

        $areas = Area::all();

        foreach ($results as $key => $item) {
            $results[$key] = AdvertController::getEntityDetails($item->id);
        }
        $zona = $request['zona'];
        $zona = implode(',', $zona);
        return view('pages.adverts')
            ->with('adverts',$results->appends(Input::except('page')))
            ->with('partitions', $partitions)
            ->with('neighborhoods', $neighborhoods)
            ->with('areas', $areas)
            ->with('type', $entity_type)
            ->with('zona', $zona)
            ->with('input_defaults', $this->getInputDefaults($entity_type));
    }

    public function loadData($values)
    {
        $neighborhood_names = explode(',', $values);
        $neighborhoods = Neighborhood::whereIn('name', $neighborhood_names)->lists('id');
        $areas = Area::whereIn('neighborhood_id', $neighborhoods)->get();
        return \Response::json($areas->lists('name'));
    }
}