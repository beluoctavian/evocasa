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
        'created_by',
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
        'created_by',
    ];

    public function owner()
    {
        return $this->hasOne('App\Owner');
    }

    public function observations()
    {
        return $this->hasMany('App\Observation');
    }

    public function apartment()
    {
        return $this->hasOne('App\Apartment');
    }

    public function house()
    {
        return $this->hasOne('App\House');
    }

    public function terrain()
    {
        return $this->hasOne('App\Terrain');
    }

    public function neighborhood()
    {
        return $this->belongsTo('App\Neighborhood');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function improvements() {
        return $this->hasOne('App\Improvements');
    }

    public function status()
    {
        return $this->hasMany('App\Status');
    }
    
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * @param array $parameters
     */
    public static function createFromArray(array $parameters, $entity_id = NULL)
    {
        $parameters['neighborhood'] = trim(ucwords(strtolower($parameters['neighborhood'])));
        $parameters['area'] = trim(ucwords(strtolower($parameters['area'])));
        $area = null;
        $neighborhood = null;
        if(!empty($parameters['neighborhood'])) {
            /** @var Neighborhood $neighborhood */
            $neighborhood = Neighborhood::where('name', $parameters['neighborhood'])->first();
            if (!$neighborhood) {
                $neighborhood = Neighborhood::create([
                    'name' => $parameters['neighborhood'],
                ]);
            }
            if(!empty($parameters['area'])) {
                /** @var Area $area */
                $area = Area::where('name', $parameters['area'])->where('neighborhood_id', $neighborhood->id)->first();
                if (!$area) {
                    $area = Area::create([
                        'name' => $parameters['area'],
                        'neighborhood_id' => $neighborhood->id,
                    ]);
                }
            }
        }
        $valid_parameters = [];
        if (!empty($neighborhood)) {
            $valid_parameters['neighborhood_id'] = $neighborhood->id;
        }
        if (!empty($area)) {
            $valid_parameters['area_id'] = $area->id;
        }
        if ($entity_id === NULL) {
            $valid_parameters['created_by'] = \Auth::user()->id;
        }
        foreach ($parameters as $key => $value) {
            if (in_array($key, self::$properties)) {
                $valid_parameters[$key] = $value;
            }
        }
        if ($entity_id) {
            /** @var Advert $advert */
            $advert = self::find($entity_id);
            $old_area = $advert->area;
            $old_neighborhood = $advert->neighborhood;

            $old_price = $advert->price;
            if (empty($parameters['neighborhood'])) {
                $advert->neighborhood_id = null;
                $advert->area_id = null;
            }
            if (empty($parameters['area'])){
                $advert->area_id = null;
            }
            $advert->fill($valid_parameters);
            $price_history = json_decode($advert->price_history, TRUE);
            if (empty($price_history)) {
                $price_history = [
                  [
                    'date' => gmdate('Y-m-d', \time()),
                    'price' => $old_price,
                  ],
                ];
            }
            if ($old_price != $advert->price) {
                $price_history[] = [
                    'date' => gmdate('Y-m-d', \time()),
                    'price' => $advert->price,
                ];
            }
            $advert->price_history = json_encode($price_history);
            $advert->save();
            if (!empty($old_area) && $old_area->advert->count() == 0) {
                $old_area->delete();
            }
            if (!empty($old_neighborhood) && $old_neighborhood->advert->count() == 0) {
                $old_neighborhood->delete();
            }
        }
        else {
            /** @var Advert $advert */
            if (!empty($valid_parameters['price'])) {
                $valid_parameters['price_history'] = json_encode([
                  [
                    'date' => gmdate('Y-m-d', \time()),
                    'price' => $valid_parameters['price'],
                  ],
                ]);
            }
            $advert = self::create($valid_parameters);
            $advert->code = \Auth::user()->code . '_' . $advert->id;
            $advert->save();
        }
        return $advert;
    }
}
