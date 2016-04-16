<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Observation extends Model {

	protected $guarded = [];

    protected $table = 'observation';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\Owner');
    }

}
