<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model {

	protected $guarded = [];

    protected $table = 'neighborhood';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advert()
    {
        return $this->hasMany('App\Advert');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function area()
    {
        return $this->hasMany('App\Area');
    }

}
