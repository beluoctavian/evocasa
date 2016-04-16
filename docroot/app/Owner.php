<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model {

	protected $guarded = [];

    protected $table = 'owner';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Advert');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function observations()
    {
        return $this->hasMany('App\Observation');
    }

}
