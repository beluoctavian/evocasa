<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Imbunat extends Model {

    protected $table = 'imbunats';

    protected $fillable = [
        'id_anunt',
        'gresie',
        'faianta',
        'termopan',
        'aer',
        'parchet',
        'instalatie_sanitara',
        'instalatie_electrica',
        'centrala',
        'mobilier',
        'usa_metalica',
        'usi_interioare',
        'contor_gaze',
        'fara_imbunatatiri'
    ];

}
