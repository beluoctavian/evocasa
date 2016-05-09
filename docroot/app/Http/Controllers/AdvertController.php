<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Observation;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Advert;
use App\Owner;
use App\Improvements;
use App\Apartment;
use App\House;
use App\Terrain;
use App\StatusType;
use App\Status;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdvertController extends Controller {

  public static $improvements = [
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

  public static $entity_attributes = [
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
    $this->middleware('auth', ['except' => ['viewEntity', ]]);
  }

  public function getIndex()
  {
    return view('advert.chooseCreationType');
  }

  public function createOrEditEntity(Request $request, $entity_type, $entity_id = NULL)
  {
    if (empty($request->get('advert')) || empty($request->get('owner')) || empty($request->get('entity'))) {
      return redirect('/advert/add/apartment')->withErrors('A aparut o eroare.');
    }
    $advert_parameters = $request->get('advert');
    $advert_parameters['type'] = $entity_type;
    $advert = Advert::createFromArray($advert_parameters, $entity_id);

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

  public static function getEntityDetails($id, $prepareForDisplay = FALSE)
  {
    /** @var Advert $advert */
    $advert = Advert::find($id);
    if ($advert == NULL) {
      return NULL;
    }
    $advert->setAttribute('area', $advert->area->name);
    $advert->setAttribute('neighborhood', $advert->neighborhood->name);
    $advert->setAttribute('price_history', json_decode($advert->price_history));
    $advert->setAttribute('user', User::find($advert->created_by)->attributesToArray());
    $advert->setAttribute('inactiv', FALSE);
    $advert->setAttribute('retras', FALSE);
    /** @var Status $statuses */
    $status = $advert->status;
    $advert_status = [];
    if (!empty($status)) {
      foreach ($status as $sts) {
        if (empty($advert_status[$sts->type_id])) {
          switch ($sts->status_type->type) {
            case 'inactiv':
              $advert->setAttribute('inactiv', TRUE);
              break;
            case 'retras':
              $advert->setAttribute('retras', TRUE);
              break;
          }
          $advert_status[$sts->type_id] = [
            'count' => 1,
            'created_at' => $sts->created_at,
            'title' =>  $sts->status_type->title,
          ];
        }
        else {
          $advert_status[$sts->type_id]['count']++;
          $advert_status[$sts->type_id]['created_at'] = ($sts->created_at > $advert_status[$sts->type_id]['created_at']) ? $sts->created_at : $advert_status[$sts->type_id]['created_at'];
        }
      }
    }
    /** @var Owner $owner */
    $owner = $advert->owner;
    $owner->setAttribute('phone', json_decode($owner->phone, TRUE));
    /** @var Collection $observations */
    $observations = $owner->observations->sort(function ($a, $b) {
      return strtotime($b->created_at) - strtotime($a->created_at);
    });
    $owner->setAttribute('observations', $observations);
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
      // Prepare the improvements
      foreach ($improvements as $key => $improvement) {
        if (!array_key_exists($key, self::$improvements)) {
          throw new \Exception('Found undeclared improvement: ' . $key);
        }
        $improvements[$key] = self::$improvements[$key];
      }

      // Prepare the entity
      $to_unset = ['id', 'advert_id', 'created_at', 'updated_at'];
      foreach ($to_unset as $to) {
        unset($entity[$to]);
      }
      foreach ($entity->getAttributes() as $key => $value) {
        if (strpos($key, 'obs_') === 0) {
          if (!array_key_exists(substr($key, 4), $entity->getAttributes())) {
            unset($entity[$key]);
          }
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
        $entity->setAttribute(self::$entity_attributes[$key], $value . $suffix);
        unset($entity[$key]);
      }

    }

    return [
      'advert' => $advert->attributesToArray(),
      'owner' => $owner->attributesToArray(),
      'entity' => $entity->attributesToArray(),
      'improvements' => $improvements,
      'status_types' => StatusType::all(),
      'advert_status' => $advert_status,
    ];
  }

  public function getCreateEntity($entity_type)
  {
    $status_types = StatusType::all();
    return view('advert.createEntity')
      ->with('entity_type', $entity_type)
      ->with('status_types', $status_types);
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
      ->with('entity_type', $details['advert']['type'])
      ->with($details)
      ->with('status_types', $details['status_types']);
  }

  public function getApartment()
  {
    return $this->getCreateEntity('apartment');
  }

  public function getHouse()
  {
    return $this->getCreateEntity('house');
  }

  public function getTerrain()
  {
    return $this->getCreateEntity('terrain');
  }

  public function postEditEntity(Request $request, $id)
  {
    $type = $request->get('entity_type');
    $this->createOrEditEntity($request, $type, $id);
    return redirect()->back()->with('success', 'Ati editat anuntul cu succes.');
  }

  public function postApartment(Request $request)
  {
    /** @var Apartment $entity */
    $entity = $this->createOrEditEntity($request, 'apartment');
    return redirect('advert/edit/' . $entity->getAttribute('advert_id'))->with('successAdd', TRUE);
  }

  public function postHouse(Request $request)
  {
    /** @var House $entity */
    $entity = $this->createOrEditEntity($request, 'house');
    return redirect('advert/edit/' . $entity->getAttribute('advert_id'))->with('successAdd', TRUE);
  }

  public function postTerrain(Request $request)
  {
    /** @var Terrain $entity */
    $entity = $this->createOrEditEntity($request, 'terrain');
    return redirect('advert/edit/' . $entity->getAttribute('advert_id'))->with('successAdd', TRUE);
  }

  public function postDeleteEntity(Request $request)
  {
    $id = $request->get('id');
    /** @var Advert $advert */
    $advert = Advert::find($id);
    $neighborhood = $advert->neighborhood;
    $area = $advert->area;
    /** @var Owner $owner */
    $owner = $advert->owner;
    $owner->observations()->delete();
    $owner->delete();
    $entity = $advert->{$advert->type};
    $entity->delete();
    $advert->improvements()->delete();
    $advert->status()->delete();
    $advert->delete();
    if ($area->advert->count() <= 1) {
      $area->delete();
    }
    if ($neighborhood->advert->count() <= 1) {
      $neighborhood->delete();
    }
    return redirect('anunturi')->with('successDelete',1);
  }

  public function updateDate($id){
    /** @var Advert $anunt */
    $anunt = Advert::find($id);
    $anunt->touch();
    return \Redirect::to(\URL::previous() . '#advert-item-no-' . $id);
  }

  public function viewEntity($id)
  {
    $details = $this->getEntityDetails($id, TRUE);
    if ($details == NULL) {
      abort(404);
    }
    $files = [];
    if (\File::exists('uploaded-images/anunt_' . $id . '/')) {
      $files = \File::allFiles('uploaded-images/anunt_' . $id . '/');
    }
    sort($files);
    return view('advert.viewEntity')
      ->with('entity_type', $details['advert']['type'])
      ->with($details)
      ->with('files', $files);
  }

  public function postAddStatus($id, Request $request)
  {
    Status::create([
      'type_id' => $request->get('status_type'),
      'advert_id' => $id,
    ]);
    return redirect('advert/edit/' . $id);
  }

  public function postDeleteStatus($id, Request $request)
  {
    $type_id = $request->get('type_id');
    /** @var Status $status */
    $status = Status::where('advert_id', '=', $id)->where('type_id', '=', $type_id)->orderBy('created_at', 'desc')->first();
    $status->delete();
    return redirect('advert/edit/' . $id);
  }

  public function postDeleteObservation($id)
  {
    /** @var Observation $observation */
    $observation = Observation::find($id);
    $advert_id = $observation->owner->advert->id;
    $observation->delete();
    return redirect('advert/edit/' . $advert_id);
  }

  public function getImages($id)
  {
    $details = $this->getEntityDetails($id, TRUE);
    if ($details == NULL) {
      abort(404);
    }
    if (!\File::exists('uploaded-images/anunt_' . $id . '/')) {
      $create = \File::makeDirectory('uploaded-images/anunt_' . $id . '/', $mode = 0777, true, true);
      if ($create === FALSE) {
        throw new \Exception("Could not create directory: uploaded-images/anunt_ . {$id}");
      }
    }
    $files = \File::allFiles('uploaded-images/anunt_' . $id . '/');
    sort($files);
    return view('advert.images')
      ->with($details)
      ->with('files', $files);
  }

  public function postImages($id, Request $request)
  {
    ini_set("memory_limit","256M");
    $destinationPath = 'uploaded-images/anunt_' . $id;
    $files = $request->file('files');
    if ($files[0] === null){
      return redirect()->back()->withErrors('Nu ati selectat niciun fisier!');
    }
    if (!\File::exists($destinationPath)) {
      $create = \File::makeDirectory($destinationPath, $mode = 0777, true, true);
      if ($create === FALSE) {
        throw new \Exception("Could not create directory: {$destinationPath}");
      }
    }
    $destinationPath = $destinationPath . '/';
    foreach ($request->file('files') as $file) {
      /** @var UploadedFile $file */
      $im_path = $destinationPath . $file->getClientOriginalName();
      $file->move($destinationPath, $file->getClientOriginalName());
      $image = imagecreatefromstring(file_get_contents($im_path));
      $watermark = imagecreatefrompng('img/evocasa_logo_big.png');

      $image_width = imagesx($image);
      $image_height = imagesy($image);

      $watermark_width = imagesx($watermark);
      $watermark_height = imagesy($watermark);

      $new_watermark_width = $watermark_width;
      $new_watermark_height = $watermark_height;
      $diffwi = 0;
      $diffhe = 0;
      if($watermark_width > $image_width){
        $diffwi = $watermark_width - $image_width;
      }
      if($watermark_height > $image_height){
        $diffhe = $watermark_height - $image_height;
      }
      if($diffwi > $diffhe){
        $new_watermark_width -= $diffwi;
        $new_watermark_height -= $diffwi;
      } else {
        $new_watermark_width -= $diffhe;
        $new_watermark_height -= $diffhe;
      }
      imagecopyresized(
        $image,                                  // Destination image
        $watermark,                              // Source image
        $image_width/2 - $new_watermark_width/2,  // Destination X
        $image_height/2 - $new_watermark_height/2, // Destination Y
        0,                                       // Source X
        0,                                       // Source Y
        $new_watermark_width,                      // Destination W
        $new_watermark_height,                     // Destination H
        imagesx($watermark),                     // Source W
        imagesy($watermark)
      );                    // Source H
      imagepng($image,$im_path);
      imagedestroy($image);
    }
    return redirect()->back()->with('success', 'Ati uploadat imaginile cu succes');
  }

  public function changeImageOrder($id, Request $request)
  {
    $path = $request->get('path');
    $numbers = $request->get('number');
    foreach ($request->get('filename') as $key => $filename) {
      $oldfilename = $filename;
      $number = $numbers[$key];
      if ($number < 10) {
        $number = '0' . $number;
      }
      $number .= '_';
      if ($filename[2] == '_') {
        $filename = substr_replace($filename,$number,0,3);
      }
      else {
        $filename = substr_replace($filename,$number,0,0);
      }
      if ( !\File::move($path . $oldfilename, $path . $filename)) {
        throw new \Exception("Couldn't rename file");
      }
    }
    return redirect()->back();
  }

}
