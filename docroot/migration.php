<?php
use App\Neighborhood;
use App\Advert;
use App\Area;
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
$advert->code = $anunt->cod;
$advert->title = $anunt->titlu;
$advert->type = $anunt->tip;
$advert->no_rooms = $anunt->nr_camere;
$advert->first_page = $anunt->first_page;
$advert->price = (int)$anunt->pret;
$advert->old_price = $anunt->pret_vechi;
$advert->description = $anunt->descriere;
$neighborhood = Neighborhood::where('name', $anunt->cartier)->first();
$area = Area::where('name', $anunt->zona)->first();

if ($neighborhood == null or $area == null) {
$neighborhood = new Neighborhood();
$neighborhood->name = $anunt->cartier;
$neighborhood->save();

$area = new Area();
$area->name = $anunt->zona;
$area->neighborhood_id = $neighborhood->id;
$area->save();

$advert->area_id = $area->id;

$advert->neighborhood_id = $neighborhood->id;
$advert->area_id = $area->id;

}
else{

$advert->area_id = $area->id;
$advert->neighborhood_id = $neighborhood->id;
$advert->save();

}

$advert->save();
$owner->advert_id = $advert->id;
$owner->save();
$observation = new Observation();
$observation->text = $proprietar->observatii;
$observation->owner_id = $owner->id;
$observation->save();

$apartment = new Apartment();
$imobil = Imobil::where('id_anunt', $anunt->id)->first();
if($imobil != null)
{
$apartment->advert_id = $advert->id;
$apartment->usable_area = zero($imobil->su);
$apartment->built_area = zero($imobil->sc);
$apartment->partitioning = zero($imobil->compartimentare);
$apartment->comfort = zero($imobil->confort);
$apartment->floor = zero($imobil->etaj);
$apartment->built_year = zero($imobil->an_constructie);
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
}
}
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
        $advert->code = $anunt->cod;
        $advert->title = $anunt->titlu;
        $advert->type = $anunt->tip;
        $advert->no_rooms = $anunt->nr_camere;
        $advert->first_page = $anunt->first_page;
        $advert->price = $anunt->pret;
        $advert->old_price = $anunt->pret_vechi;
        $advert->description = $anunt->descriere;
        $neighborhood = Neighborhood::where('name', $anunt->cartier)->first();
        $area = Area::where('name', $anunt->zona)->first();

        if ($neighborhood == null or $area == null) {
            $neighborhood = new Neighborhood();
            $neighborhood->name = $anunt->cartier;
            $neighborhood->save();

            $area = new Area();
            $area->name = $anunt->zona;
            $area->neighborhood_id = $neighborhood->id;
            $area->save();

            $advert->area_id = $area->id;

            $advert->neighborhood_id = $neighborhood->id;
            $advert->area_id = $area->id;

        }
        else{

            $advert->area_id = $area->id;
            $advert->neighborhood_id = $neighborhood->id;
            $advert->save();

        }

        $advert->save();
        $owner->advert_id = $advert->id;
        $owner->save();
        $observation = new Observation();
        $observation->text = $proprietar->observatii;
        $observation->owner_id = $owner->id;
        $observation->save();

        $apartment = new Apartment();
        $imobil = Imobil::where('id_anunt', $anunt->id)->first();
        if($imobil != null)
        {
            $apartment->advert_id = $advert->id;
            $apartment->usable_area = zero($imobil->su);
            $apartment->built_area = zero($imobil->sc);
            $apartment->partitioning = zero($imobil->compartimentare);
            $apartment->comfort = zero($imobil->confort);
            $apartment->floor = zero($imobil->etaj);
            $apartment->built_year = zero($imobil->an_constructie);
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
    }
}

 function zero($a)
{
    if($a == null)
        return '';
    return $a;
}