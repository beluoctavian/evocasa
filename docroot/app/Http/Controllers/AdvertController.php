<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advert;
use App\Owner;
use App\Apartment;
use App\Improvements;

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
    return view('advert.createEntity')->with('entity_type', 'apartment');
  }

  public function getHouse()
  {
    return view('advert.createEntity')->with('entity_type', 'house');
  }

  public function getTerrain()
  {
    return view('advert.createEntity')->with('entity_type', 'terrain');
  }

  public function postApartment(Request $request)
  {
    $advert_parameters = $request->advert;
    $advert_parameters['type'] = 'apartment';
    $advert = Advert::createFromArray($advert_parameters);

    $owner = Owner::createFromArray($request->owner, $advert);

    $apartment = Apartment::createFromArray($request->house, $advert);

    $improvements = Improvements::createFromArray($request->improvements, $advert);
  }

}
