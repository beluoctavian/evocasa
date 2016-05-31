<?php
use App\Owner;
use App\Proprietar;
use App\Apartment;
use App\Imobil;
use App\Observation;
use App\Advert;
$proprietars = DB::table('proprietars')->get();
$ceva = 0;
foreach($proprietars as $proprietar) {
    $owner = Owner::where('advert_id', $proprietar->id_anunt)->first();

    if($owner){

        $phone = $proprietar->telefon;
        $phone = explode(',', $phone);
        unset($phone[count($phone) -1]);
        $phone = json_encode($phone);
        $owner->phone = $phone;
        $owner->save();
        if (!empty($proprietar->observatii)) {
            $observation = Observation::where('owner_id', $owner->id)->first() ;
            if(!$observation)
                $observation = new Observation();
            $observation->text = $proprietar->observatii;
            $observation->owner_id = $owner->id;
            $observation->save();
        }
    }


    $anunt = DB::table('anunts')->find($proprietar->id_anunt);
    if ($anunt != null) {

        $imobil = Imobil::where('id_anunt', $anunt->id)->first();

        if($imobil != null)
        {
            $advert = Advert::find($anunt->id);
            $advert->created_at = $anunt->created_at;
            $advert->updated_at = $anunt->updated_at;
            $advert->save();
            $apartment = Apartment::where('advert_id', $advert->id)->first();

//            echo $imobil->created_at . PHP_EOL;

            if($apartment != null){

            if(isset($imobil->createad_at))
            $apartment->created_at = $imobil->created_at;


            if(!empty($imobil->updated_at))
                $apartment->updated_at = $imobil->updated_at;
            else
                $apartment->updated_at = $imobil->created_at;

            $apartment->bathrooms = $imobil->numbar_bai;
            $apartment->save();

            $apartment->obs_bathrooms = (string)$imobil->obs_numbar_bai;
            $apartment->sanitary = (string)$imobil->numbar_bai_serviciu;
            $apartment->obs_sanitary = (string)$imobil->obs_numbar_bai_serviciu;
            $apartment->balconies = (string)$imobil->numbar_balcoane;
            $apartment->obs_balconies = (string)$imobil->obs_numbar_balcoane;
            $apartment->save();

//            echo $apartment->created_at . PHP_EOL;

            echo 'update apartment ' . $apartment->id . PHP_EOL;
                $ceva ++;

            }


        }
    }

}

echo $ceva;