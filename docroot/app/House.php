<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model {

	protected $guarded = [];

    protected $table = 'house';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert()
    {
        return $this->belongsTo('App\Advert');
    }

}
