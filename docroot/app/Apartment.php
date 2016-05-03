<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model {

	protected $guarded = [];

    protected $table = 'apartment';

    protected $fillable = [
      'usable_area',
      'built_area',
      'partitioning',
      'comfort',
      'floor',
      'built_year',
      'bathrooms',
      'obs_bathrooms',
      'sanitary',
      'obs_sanitary',
      'balconies',
      'obs_balconies',
      'parking',
      'obs_parking',
      'storeroom',
      'obs_storeroom',
      'garage',
      'obs_garage',
      'advert_id',
    ];

    public static $properties = [
      'usable_area',
      'built_area',
      'partitioning',
      'comfort',
      'floor',
      'built_year',
      'bathrooms',
      'obs_bathrooms',
      'sanitary',
      'obs_sanitary',
      'balconies',
      'obs_balconies',
      'parking',
      'obs_parking',
      'storeroom',
      'obs_storeroom',
      'garage',
      'obs_garage',
      'advert_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
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
        $valid_parameters = [];
        foreach ($parameters as $key => $value) {
            if (in_array($key, self::$properties)) {
                $valid_parameters[$key] = $value;
            }
        }
        $valid_parameters['advert_id'] = $advert->id;

        $exists = $advert->apartment;
        if ($exists) {
            $exists->fill($valid_parameters);
            $exists->save();
            return $exists;
        }
        return self::create($valid_parameters);
    }

}
