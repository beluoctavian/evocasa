<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Terrain extends Model {

	protected $guarded = [];

    protected $table = 'terrain';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }

}
