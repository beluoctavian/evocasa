<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Improvements extends Model {

  protected $table = 'improvements';

  protected $fillable = [
    'improvements',
    'advert_id',
  ];

  public static $properties = [
    'improvements',
    'advert_id',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function advert() {
    return $this->belongsTo('App\Advert');
  }

  /**
   * @param array $parameters
   * @param \App\Advert $advert
   * @return static
   */
  public static function createFromArray(array $parameters, Advert $advert)
  {
    if (empty($parameters)) {
      $parameters = [];
    }
    $valid_parameters = [
      'improvements' => json_encode($parameters),
      'advert_id' => $advert->id,
    ];
    return self::create($valid_parameters);
  }

}
