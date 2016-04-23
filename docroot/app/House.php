<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model {

	protected $guarded = [];

    protected $table = 'house';

    protected $fillable = [
      'land_area',
      'street_opening',
      'footprint',
      'total_area',
      'level_area',
      'height',
      'built_year',
      'bathrooms',
      'obs_bathrooms',
      'sanitary',
      'obs_sanitary',
      'balconies',
      'obs_balconies',
      'garage',
      'obs_garage',
      'advert_id',
    ];

    public static $properties = [
        'land_area',
        'street_opening',
        'footprint',
        'total_area',
        'level_area',
        'height',
        'built_year',
        'bathrooms',
        'obs_bathrooms',
        'sanitary',
        'obs_sanitary',
        'balconies',
        'obs_balconies',
        'garage',
        'obs_garage',
        'advert_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }

    /**
     * @param array $parameters
     * @param \App\Advert $advert
     * @return static
     */
    public static function createFromArray(array $parameters, Advert $advert)
    {
        $valid_parameters = [
          'advert_id' => $advert->id,
        ];
        foreach ($parameters as $key => $value) {
            if (in_array($key, self::$properties)) {
                $valid_parameters[$key] = $value;
            }
        }
        return self::create($valid_parameters);
    }

}
