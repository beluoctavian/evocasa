<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model {

    protected $guarded = [];

    protected $table = 'advert';

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
    public function heighborhood()
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
     * @param array $parameters
     */
    public static function createFromArray(array $parameters)
    {
        //@ToDo: Create neighborhood & area
        $neighborhood = Neighborhood::where('name', $parameters['neighborhood'])->first();
        if (!$neighborhood) {
            $neighborhood = Neighborhood::create([
              'name' => $parameters['neighborhood'],
            ]);
        }
        $area = Area::where('name', $parameters['area'])->where('neighborhood_id', $neighborhood->id)->first();
        if (!$area) {
            $area = Area::create([
              'name' => $parameters['area'],
              'neighborhood_id' => $neighborhood->id,
            ]);
        }
        $advert = Advert::create([
          'title' => $parameters['title'],
          'first_page' => !empty($parameters['first_page']),
          'type' => $parameters['type'],
          'no_rooms' => $parameters['no_rooms'],
          'price' => $parameters['price'],
          'old_price' => $parameters['old_price'],
          'description' => $parameters['description'],
          'neighborhood_id' => $neighborhood->id,
          'area_id' => $area->id,
        ]);
        return $advert;
    }
}
