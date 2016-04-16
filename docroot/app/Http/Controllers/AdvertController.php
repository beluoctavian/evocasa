<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advert;

class AdvertController extends Controller {

  public function __construct()
  {
    $this->middleware('auth');
  }

  private function createAdvert(array $parameters) {
    //@ToDo: Create neighborhood & area
    return Advert::create([
      'title' => $parameters['title'],
      'first_page' => !empty($parameters['first_page']),
      'type' => $parameters['type'],
      'no_rooms' => $parameters['no_rooms'],
      'price' => $parameters['price'],
      'old_price' => $parameters['old_price'],
      'description' => $parameters['description'],
    ]);
  }

  public function getIndex()
  {
    return view('advert.chooseCreationType');
  }

  public function getApartment(){
    return view('advert.createApartment');
  }

  public function postApartment(Request $request) {
    $advert_parameters = $request->advert;
    $advert_parameters['type'] = 'apartment';
    $advert = $this->createAdvert($request->advert);
  }

}
