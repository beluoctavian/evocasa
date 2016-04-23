<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model {

	protected $guarded = [];

    protected $table = 'apartment';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function advert()
    {
        return $this->hasOne('App\Advert');
    }

}
