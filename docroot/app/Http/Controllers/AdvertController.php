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

  public function createEntity(Request $request, $entity_type) {
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

  /**
   * @param $id
   *  Entity unique id.
   * @return $this
   */
  public function editEntity($id) {
    /** @var Advert $advert */
    $advert = Advert::find($id);
    $owner = $advert->owner;
    $entity = $advert->{$advert->type};
    $improvements = json_decode($advert->improvements->improvements, TRUE);
    return view('advert.createEntity')
      ->with('entity_type', $advert->type)
      ->with('advert', $advert->attributesToArray())
      ->with('owner', $owner->attributesToArray())
      ->with('entity', $entity->attributesToArray())
      ->with('improvements', $improvements);
  }

  public function postApartment(Request $request)
  {
    $entity = $this->createEntity($request, 'apartment');
    return view('advert.createEntity')->with('entity_type', 'apartment');
  }

  public function postHouse(Request $request)
  {
    $entity = $this->createEntity($request, 'house');
    return view('advert.createEntity')->with('entity_type', 'house');
  }

  public function postTerrain(Request $request)
  {
    $entity = $this->createEntity($request, 'terrain');
    return view('advert.createEntity')->with('entity_type', 'terrain');
  }

}
