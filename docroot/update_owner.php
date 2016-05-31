<?php
use App\Owner;
use App\Proprietar;

$proprietars = DB::table('proprietars')->get();

foreach($proprietars as $proprietar) {
    $owner = Owner::where('advert_id', $proprietar->id_anunt)->first();

    if($owner){

        echo $owner->id. '  ';
        $phone = $proprietar->telefon;
        $phone = explode(',', $phone);
        unset($phone[count($phone) -1]);
        $phone = json_encode($phone);
        $owner->phone = $phone;
        $owner->save();
    }
}