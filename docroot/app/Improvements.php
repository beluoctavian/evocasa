<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Improvements extends Model {

  protected $table = 'improvements';

  public static $properties = [
    'improvements',
    'advert_id',
  ];

  public static function createFromArray(array $parameters, Advert $advert)
  {
    $valid_parameters = [
      'improvements' => json_encode($parameters),
      'advert_id' => $advert->id,
    ];
    return self::create($valid_parameters);
  }

}
