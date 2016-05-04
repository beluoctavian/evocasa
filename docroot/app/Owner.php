<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model {

	protected $guarded = [];

    protected $table = 'owner';

    protected $fillable = [
      'first_name',
      'last_name',
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

    public static $properties = [
      'first_name',
      'last_name',
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
        return $this->belongsTo('App\Advert');
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
    public static function createFromArray(array $parameters, Advert $advert)
    {
        $valid_parameters = [];
        foreach ($parameters as $key => $value) {
            if (in_array($key, self::$properties)) {
                $valid_parameters[$key] = $value;
            }
        }
        if (!empty($parameters['phone'])) {
            $valid_parameters['phone'] = [];
            foreach ($parameters['phone'] as $phone) {
                if (!empty($phone)) {
                    $valid_parameters['phone'][] = $phone;
                }
            }
            $valid_parameters['phone'] = json_encode($valid_parameters['phone']);
        }
        $valid_parameters['advert_id'] = $advert->id;
        $owner = $advert->owner;
        if ($owner) {
            $owner->fill($valid_parameters);
            $owner->save();
        }
        else {
            $owner = self::create($valid_parameters);
        }
        if (!empty($parameters['observation'])) {
            Observation::create([
                'text' => $parameters['observation'],
                'owner_id' => $owner->id,
            ]);
        }
        return $owner;
    }

}
