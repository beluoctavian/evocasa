<?php
use App\Neighborhood;
use App\Advert;
use App\Area;
use App\Imbunat;
use App\Owner;
use App\Observation;
use App\Imobil;
use App\Apartment;

$proprietars = DB::table('proprietars')->get();
foreach($proprietars as $proprietar) {
    $owner = new Owner();
    $owner->first_name = $proprietar->prenume;
    $owner->last_name = $proprietar->nume;
    $owner->phone = $proprietar->telefon;
    $owner->email = $proprietar->email;
    $owner->address = $proprietar->adresa;
    $owner->cadaster = $proprietar->cadastru;
    $owner->registration = $proprietar->intabulare;
    $owner->energy_certificate = $proprietar->certificat_energetic;
    $owner->urbanism_certificate = '';
    $owner->map_pictures = $proprietar->poze_map;


    $anunt = DB::table('anunts')->find($proprietar->id_anunt);

    if ($anunt != null) {
        $advert = new Advert();
        $advert->id = $anunt->id;
        $advert->created_by = strstr($anunt->cod, 'IC') === FALSE ? 2 : 1;
        $advert->code = $anunt->cod;
        $advert->title = $anunt->titlu;
        $advert->type = 'apartment';
        $advert->no_rooms = $anunt->nr_camere;
        $advert->price = $anunt->pret;
        $advert->old_price = $anunt->pret_vechi;
        $advert->description = $anunt->descriere;
        $advert->created_at = $anunt->created_at;
        $advert->updated_at = $anunt->updated_at;
        $anunt->cartier = ucwords(strtolower($anunt->cartier));
        $anunt->zona = ucwords(strtolower($anunt->zona));
        $neighborhood = Neighborhood::where('name', $anunt->cartier)->first();
        if (!$neighborhood) {
            $neighborhood = Neighborhood::create([
                'name' => $anunt->cartier,
            ]);
        }
        /** @var Area $area */
        $area = Area::where('name', $anunt->zona)->where('neighborhood_id', $neighborhood->id)->first();
        if (!$area) {
            $area = Area::create([
                'name' => $anunt->zona,
                'neighborhood_id' => $neighborhood->id,
            ]);
        }

        $advert->area_id = $area->id;
        $advert->neighborhood_id = $neighborhood->id;

        $advert->save();
        $owner->advert_id = $advert->id;
        $owner->save();
        if (!empty($proprietar->observatii)) {
            $observation = new Observation();
            $observation->text = $proprietar->observatii;
            $observation->owner_id = $owner->id;
            $observation->save();
        }

        $apartment = new Apartment();
        $imobil = Imobil::where('id_anunt', $anunt->id)->first();
        if($imobil != null)
        {
            $apartment->advert_id = $advert->id;
            $su = (int) zero($imobil->su) == zero($imobil->su) ? (int) zero($imobil->su) : zero($imobil->su);
            $sc = (int) zero($imobil->sc) == zero($imobil->sc) ? (int) zero($imobil->sc) : zero($imobil->sc);
            $apartment->usable_area = $su;
            $apartment->built_area = $sc;
            $apartment->partitioning = ucwords(strtolower(zero($imobil->compartimentare)));
            $apartment->comfort = zero($imobil->confort);
            $apartment->floor = zero($imobil->etaj);
            $year = (int) zero($imobil->an_constructie);
            $apartment->built_year = $year;
            $apartment->bathrooms = zero($imobil->numar_bai);
            $apartment->obs_bathrooms = zero($imobil->obs_numar_bai);
            $apartment->sanitary = zero($imobil->numar_bai_serviciu);
            $apartment->obs_sanitary = zero($imobil->obs_numar_bai_serviciu);
            $apartment->balconies = zero($imobil->numar_balcoane);
            $apartment->obs_balconies = zero($imobil->obs_numar_balcoane);
            $apartment->parking = zero($imobil->loc_parcare);
            $apartment->obs_parking = zero($imobil->obs_loc_parcare);
            $apartment->storeroom = zero($imobil->boxa);
            $apartment->obs_storeroom = zero($imobil->obs_boxa);
            $apartment->garage = zero($imobil->garaj);
            $apartment->obs_garage = zero($imobil->obs_garaj);
            $apartment->save();
        }
        $imbunatatire = Imbunat::where('id_anunt', $anunt->id)->first();
        unset($imbunatatire->id);
        unset($imbunatatire->id_anunt);
        unset($imbunatatire->created_at);
        unset($imbunatatire->updated_at);
        $improvement = new \App\Improvements();
        $improvement->id = $imbunatatire->id;
        $improvement->advert_id = $advert->id;
        $improvement->improvements = json_encode($imbunatatire);
        $improvement->save();

        foreach(explode(',',$anunt->status) as $status_name)
        {

            if($status_name == 'inactiv')
            {
                $status = new \App\Status();
                $status->type_id = 7;
                $status->advert_id = $advert->id;
                $status->save();
            }
            if($status_name == 'retras')
            {
                $status = new \App\Status();

                $status->type_id = 6;
                $status->advert_id = $advert->id;
                $status->save();
            }
            if($status_name == 'nuColaboreaza')
            {
                $status = new \App\Status();

                $status->type_id = 5;
                $status->advert_id = $advert->id;
                $status->save();
            }
            if($status_name == 'telefonInchis')
            {
                $status = new \App\Status();

                $status->type_id = 4;
                $status->advert_id = $advert->id;
                $status->save();
            }
            if($status_name == 'nuRaspunde')
            {
                $status = new \App\Status();

                $status->type_id = 3;
                $status->advert_id = $advert->id;
                $status->save();
            }
            if($status_name == 'telefonDat')
            {
                $status = new \App\Status();

                $status->type_id = 2;
                $status->advert_id = $advert->id;
                $status->save();
            }
            if($status_name == 'recomandat')
            {
                $status = new \App\Status();
                $status->type_id = 1;
                $status->advert_id = $advert->id;
                $status->save();
            }
            if($anunt->first_page == 1)
            {
                $status = new \App\Status();
                $status->type_id = 1;
                $status->advert_id = $advert->id;
                $status->save();
            }


        }
        print 'Success created advert id='.$advert->id. PHP_EOL;
    }
}

 function zero($a)
{
    if($a == null)
        return '';
    return $a;
}