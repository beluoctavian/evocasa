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
     * @param array $parameters
     */
    public static function createFromArray(array $parameters)
    {
        //@ToDo: Create neighborhood & area
        return $this->create([
          'title' => $parameters['title'],
          'first_page' => !empty($parameters['first_page']),
          'type' => $parameters['type'],
          'no_rooms' => $parameters['no_rooms'],
          'price' => $parameters['price'],
          'old_price' => $parameters['old_price'],
          'description' => $parameters['description'],
        ]);
    }
}
