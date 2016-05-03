<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model {

    protected $guarded = [];

    protected $table = 'area';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function neighborhood()
    {
        return $this->belongsTo('App\Neighborhood');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advert()
    {
        return $this->hasMany('App\Advert');
    }

}
