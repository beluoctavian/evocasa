<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Advert;
use App\Owner;
use App\Improvements;
use App\Apartment;
use App\House;
use App\Terrain;

class AdvertController extends Controller {

  public $improvements = [
    'gresie' => 'Gresie',
    'faianta' => 'Faianta',
    'parchet' => 'Parchet',
    'termopan' => 'Termopan',
    'aer' => 'Aer conditionat',
    'instalatie_sanitara' => 'Instalatie sanitara',
    'instalatie_electrica' => 'Instalatie electrica',
    'contor_gaze' => 'Contor gaze',
    'centrala' => 'Centrala',
    'mobilier' => 'Mobilier',
    'usi_interioare' => 'Usi interioare',
    'usa_metalica' => 'Usa metalica',
    'fara_imbunatatiri' => 'Fara imbunatatiri',
    'canalizare' => 'Canalizare',
    'apa_curenta' => 'Apa curenta',
    'gaze' => 'Gaze',
    'electricitate' => 'Electricitate',
    'modernizat' => 'Modernizat',
  ];

  public $entity_attributes = [
    'usable_area' => 'Suprafata utila',
    'built_area' => 'Suprafata construita',
    'partitioning' => 'Compartimentare',
    'comfort' => 'Confort',
    'floor' => 'Etaj',
    'built_year' => 'An constructie',
    'bathrooms' => 'Numar bai',
    'obs_bathrooms' => 'Observatii numar bai',
    'sanitary' => 'Nr. gr. sanitare',
    'obs_sanitary' => 'Observatii nr. gr. sanitare',
    'balconies' => 'Numar balcoane',
    'obs_balconies' => 'Observatii numar balcoane',
    'parking' => 'Loc parcare',
    'obs_parking' => 'Observatii loc parcare',
    'storeroom' => 'Boxa',
    'obs_storeroom' => 'Observatii boxa',
    'garage' => 'Garaj',
    'obs_garage' => 'Observatii garaj',
    'land_area' => 'Suprafata teren',
    'street_opening' => 'Deschidere stradala',
    'footprint' => 'Amprenta la sol',
    'total_area' => 'Suprafata desfasurata totala',
    'level_area' => 'Suprafata per nivel',
    'height' => 'Regim inaltime',
    'depth' => 'Adancime',
    'access_width' => 'Latime drum acces',
  ];

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
    if (empty($request->get('advert')) || empty($request->get('owner')) || empty($request->get('entity'))) {
      return redirect('/advert/add/apartment')->withErrors('A aparut o eroare.');
    }
    $advert_parameters = $request->get('advert');
    $advert_parameters['type'] = $entity_type;
    $advert = Advert::createFromArray($advert_parameters);

    Owner::createFromArray($request->get('owner'), $advert);

    Improvements::createFromArray($request->get('improvements') ?: [], $advert);

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

  public function getEntityDetails($id, $prepareForDisplay = FALSE)
  {
    /** @var Advert $advert */
    $advert = Advert::find($id);
    if ($advert == NULL) {
      return NULL;
    }
    /** @var Owner $owner */
    $owner = $advert->owner;
    $owner->setAttribute('phone', json_decode($owner->phone, TRUE));
    /** @var Model $entity */
    $entity = $advert->{$advert->type};
    /** @var Improvements $improvements */
    $improvements = json_decode($advert->improvements->improvements, TRUE);

    if ($prepareForDisplay === TRUE) {
      // Prepare the advert
      switch ($advert->getAttribute('type')) {
        case 'apartment':
          $advert->setAttribute('type', 'apartament');
          break;
        case 'house':
          $advert->setAttribute('type', 'casa');
          break;
        case 'terrain':
          $advert->setAttribute('type', 'teren');
          break;

      }
      $advert->setAttribute('area', $advert->area->name);
      $advert->setAttribute('neighborhood', $advert->neighborhood->name);

      // Prepare the improvements
      foreach ($improvements as $key => $improvement) {
        if (!array_key_exists($key, $this->improvements)) {
          throw new \Exception('Found undeclared improvement: ' . $key);
        }
        $improvements[$key] = $this->improvements[$key];
      }

      // Prepare the entity
      $to_unset = ['id', 'advert_id', 'created_at', 'updated_at'];
      foreach ($to_unset as $to) {
        unset($entity[$to]);
      }
      foreach ($entity->getAttributes() as $key => $value) {
        if (strpos($key, 'obs_') === 0) {
          continue;
        }
        if (empty($value)) {
          unset($entity[$key]);
          continue;
        }
        $suffix = '';
        $mp = [
          'usable_area',
          'built_area',
          'land_area',
          'footprint',
          'total_area',
          'level_area',
        ];
        $ml = [
          'street_opening',
          'height',
          'depth',
          'access_width',
        ];
        if (in_array($key, $mp)) {
          $suffix .= " mp";
        }
        if (in_array($key, $ml)) {
          $suffix .= " ml";
        }
        if (array_key_exists("obs_{$key}", $entity->getAttributes())) {
          $suffix .= " ({$entity["obs_{$key}"]})";
          unset($entity["obs_{$key}"]);
        }
        $entity->setAttribute($this->entity_attributes[$key], $value . $suffix);
        unset($entity[$key]);
      }

    }

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
    if ($details == NULL) {
      abort(404);
    }
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
    /** @var Apartment $entity */
    $entity = $this->createEntity($request, 'apartment');
    return redirect('advert/edit/' . $entity->getAttribute('advert_id'))->with('successAdd', TRUE);
  }

  public function postHouse(Request $request)
  {
    /** @var House $entity */
    $entity = $this->createEntity($request, 'house');
    return redirect('advert/edit/' . $entity->getAttribute('advert_id'))->with('successAdd', TRUE);
  }

  public function postTerrain(Request $request)
  {
    /** @var Terrain $entity */
    $entity = $this->createEntity($request, 'terrain');
    return redirect('advert/edit/' . $entity->getAttribute('advert_id'))->with('successAdd', TRUE);
  }

  public function viewEntity($id)
  {
    $details = $this->getEntityDetails($id, TRUE);
    if ($details == NULL) {
      abort(404);
    }
    return view('advert.viewEntity')
      ->with('entity_type', $details['advert']['type'])->with($details);
  }

}
