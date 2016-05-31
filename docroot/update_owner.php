<?php
use App\Owner;
use App\Proprietar;
use App\Apartment;
use App\Imobil;
use App\Advert;
$proprietars = DB::table('proprietars')->get();

foreach($proprietars as $proprietar) {
    $owner = Owner::where('advert_id', $proprietar->id_anunt)->first();

    if($owner){

        $phone = $proprietar->telefon;
        $phone = explode(',', $phone);
        unset($phone[count($phone) -1]);
        $phone = json_encode($phone);
        $owner->phone = $phone;
        $owner->save();
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
            $apartment = Apartment::find($anunt->id);
//            echo $imobil->created_at . PHP_EOL;

            $apartment->created_at = $imobil->created_at;


            if(!empty($imobil->updated_at))
                $apartment->updated_at = $imobil->updated_at;
            else
                $apartment->updated_at = $imobil->created_at;

            $apartment->bathrooms = zero($imobil->numbar_bai);
            $apartment->obs_bathrooms = zero($imobil->obs_numbar_bai);
            $apartment->sanitary = zero($imobil->numbar_bai_serviciu);
            $apartment->obs_sanitary = zero($imobil->obs_numbar_bai_serviciu);
            $apartment->balconies = zero($imobil->numbar_balcoane);
            $apartment->obs_balconies = zero($imobil->obs_numbar_balcoane);
            $apartment->save();
//            echo $apartment->created_at . PHP_EOL;

            echo 'update apartment ' . $apartment->id . PHP_EOL;

        }
    }

}


function zero($a)
{
    if($a == null)
        return '';
    return $a;
}