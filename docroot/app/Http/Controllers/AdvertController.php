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

  public function createEntity(Request $request, $entity_type)
  {
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

  public function getEntityDetails($id)
  {
    /** @var Advert $advert */
    $advert = Advert::find($id);
    /** @var Owner $owner */
    $owner = $advert->owner;
    $owner->setAttribute('phone', json_decode($owner->phone, TRUE));
    $entity = $advert->{$advert->type};
    /** @var Improvements $improvements */
    $improvements = json_decode($advert->improvements->improvements, TRUE);
    $advert->setAttribute('area', $advert->area->name);
    $advert->setAttribute('neighborhood', $advert->neighborhood->name);

    return [
      'advert' => $advert->attributesToArray(),
      'owner' => $owner->attributesToArray(),
      'entity' => $entity->attributesToArray(),
      'improvements' => $improvements,
    ];
  }

  /**
   * @param $id
   *  Entity unique id.
   * @return $this
   */
  public function getEditEntity($id)
  {
    $details = $this->getEntityDetails($id);
    return view('advert.createEntity')
      ->with('entity_type', $details['advert']['type'])->with($details);
  }

  public function postEditEntity(Request $request, $id)
  {
    //TODO: Edit the entity
    return $this->getEditEntity($id);
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

  public function viewEntity($id)
  {
    $details = $this->getEntityDetails($id);
    return view('advert.viewEntity')
      ->with('entity_type', $details['advert']['type'])->with($details);
  }

}
