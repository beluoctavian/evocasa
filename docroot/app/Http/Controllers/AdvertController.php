<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advert;
use App\Owner;

class AdvertController extends Controller {

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getIndex()
  {
    return view('advert.chooseCreationType');
  }

  public function getApartment()
  {
    return view('advert.createApartment');
  }

  public function postApartment(Request $request)
  {
    $advert_parameters = $request->advert;
    $advert_parameters['type'] = 'apartment';
    $advert = Advert::createFromArray($advert_parameters);

    $owner = Owner::createFromArray($request->owner, $advert);
  }

}
