<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model {

    protected $guarded = [];

    protected $table = 'advert';

    protected $fillable = [
        'code',
        'title',
        'type',
        'no_rooms',
        'first_page',
        'price',
        'old_price',
        'description',
        'neighborhood_id',
        'area_id',
        'price_history',
    ];

    public static $properties = [
        'code',
        'title',
        'type',
        'no_rooms',
        'first_page',
        'price',
        'old_price',
        'description',
        'neighborhood_id',
        'area_id',
        'price_history',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner()
    {
        return $this->hasOne('App\Owner');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function observations()
    {
        return $this->hasMany('App\Observation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function apartment()
    {
        return $this->hasOne('App\Apartment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function house()
    {
        return $this->hasOne('App\House');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function terrain()
    {
        return $this->hasOne('App\Terrain');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function neighborhood()
    {
        return $this->belongsTo('App\Neighborhood');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function improvements() {
        return $this->hasOne('App\Improvements');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function status()
    {
        return $this->hasMany('App\Status');
    }

    /**
     * @param array $parameters
     */
    public static function createFromArray(array $parameters, $entity_id = NULL)
    {
        $parameters['neighborhood'] = ucwords(strtolower($parameters['neighborhood']));
        $parameters['area'] = ucwords(strtolower($parameters['area']));
        /** @var Neighborhood $neighborhood */
        $neighborhood = Neighborhood::where('name', $parameters['neighborhood'])->first();
        if (!$neighborhood) {
            $neighborhood = Neighborhood::create([
              'name' => $parameters['neighborhood'],
            ]);
        }
        /** @var Area $area */
        $area = Area::where('name', $parameters['area'])->where('neighborhood_id', $neighborhood->id)->first();
        if (!$area) {
            $area = Area::create([
              'name' => $parameters['area'],
              'neighborhood_id' => $neighborhood->id,
            ]);
        }
        $valid_parameters = [
          'neighborhood_id' => $neighborhood->id,
          'area_id' => $area->id,
        ];
        foreach ($parameters as $key => $value) {
            if (in_array($key, self::$properties)) {
                $valid_parameters[$key] = $value;
            }
        }
        if ($entity_id) {
            /** @var Advert $advert */
            $advert = self::find($entity_id);
            $old_neighborhood = $advert->neighborhood;
            $old_area = $advert->area;
            $old_price = $advert->price;
            $advert->fill($valid_parameters);
            $price_history = json_decode($advert->price_history);
            if (empty($price_history)) {
                $price_history = [$old_price];
            }
            if ($old_price != $advert->price) {
                $price_history[] = $advert->price;
            }
            $advert->price_history = json_encode($price_history);
            $advert->save();
            if ($old_area->advert->count() == 0) {
                $old_area->delete();
            }
            if ($old_neighborhood->advert->count() == 0) {
                $old_neighborhood->delete();
            }
        }
        else {
            /** @var Advert $advert */
            $advert = self::create($valid_parameters);
            $advert->code = \Auth::user()->code . '_' . $advert->id;
            $advert->save();
        }
        return $advert;
    }
}
