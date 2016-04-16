<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Imobil extends Model {

    protected $table = 'imobils';

    protected $fillable = [
        'id_anunt',
        'su',
        'sc',
        'compartimentare',
        'confort',
        'etaj',
        'numbar_bai',
        'obs_numbar_bai',
        'numbar_bai_serviciu',
        'obs_numbar_bai_serviciu',
        'numbar_balcoane',
        'obs_numbar_balcoane',
        'an_constructie',
        'loc_parcare',
        'obs_loc_parcare',
        'boxa',
        'obs_boxa',
        'garaj',
        'obs_garaj'
    ];

}
