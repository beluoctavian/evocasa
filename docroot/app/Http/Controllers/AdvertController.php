<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Advert;
use App\Owner;
use App\Improvements;
use App\Apartment;
use App\House;
use App\Terrain;

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

  private function createEntity(Request $request, $entity_type) {
    if (empty($request->get('advert')) || empty($request->get('owner')) || empty($request->get('entity')) || empty($request->get('improvements'))) {
      return redirect('/advert/add/apartment')->withErrors('A aparut o eroare.');
    }
    $advert_parameters = $request->advert;
    $advert_parameters['type'] = $entity_type;
    $advert = Advert::createFromArray($advert_parameters);

    Owner::createFromArray($request->owner, $advert);

    Improvements::createFromArray($request->improvements, $advert);

    switch($entity_type) {
      case 'house':
        $entity = House::createFromArray($request->get('entity'), $advert);
        break;
      case 'terrain':
        $entity = Terrain::createFromArray($request->get('entity'), $advert);
        break;
      default:
        $entity = Apartment::createFromArray($request->get('entity'), $advert);
    }

    return $entity;
  }

  public function postApartment(Request $request)
  {
    $apartment = $this->createEntity($request, 'apartment');
    return view('advert.createEntity')->with('entity_type', 'apartment');
  }

  public function postHouse(Request $request)
  {
    $apartment = $this->createEntity($request, 'house');
    return view('advert.createEntity')->with('entity_type', 'house');
  }

  public function postTerrain(Request $request)
  {
    $apartment = $this->createEntity($request, 'terrain');
    return view('advert.createEntity')->with('entity_type', 'terrain');
  }

}
