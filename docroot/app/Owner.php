<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model {

	protected $guarded = [];

    protected $table = 'owner';

    public static $properties = [
      'firstname',
      'surname',
      'phone',
      'email',
      'cadaster',
      'registration',
      'energy_certificate',
      'urbanism_certificate',
      'map_pictures',
      'rehabilitated_block',
      'address',
      'advert_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert()
    {
        return $this->hasOne('App\Advert');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function observations()
    {
        return $this->hasMany('App\Observation');
    }

    /**
     * @param array $parameters
     */
    public static function createFromArray(array $parameters, Advert $advert) {
        $valid_parameters = [];
        foreach ($parameters as $key => $value) {
            if (in_array($key, self::$properties)) {
                $valid_parameters[$key] = $value;
            }
        }
        if (!empty($parameters['phone'])) {
            $valid_parameters['phone'] = json_encode($parameters['phone']);
        }
        $valid_parameters['advert_id'] = $advert->id;
        return Owner::create($valid_parameters);
    }

}
