<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusType extends Model {

	protected $guarded = [];

    protected $table = 'status_type';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function status()
    {
        return $this->hasMany('App\Status');
    }

}
