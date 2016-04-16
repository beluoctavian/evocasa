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
}
