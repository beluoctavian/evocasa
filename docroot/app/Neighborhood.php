<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model {

	protected $guarded = [];

    protected $table = 'neighborhood';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->hasOne('App\Area');
    }

}
