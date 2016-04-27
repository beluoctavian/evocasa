<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

	protected $guarded = [];

    protected $table = 'status';

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
    public function status_type()
    {
        return $this->belongsTo('App\StatusType', 'type_id');
    }

}
