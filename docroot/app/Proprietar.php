<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Proprietar extends Model {

    protected $table = 'proprietars';

    protected $fillable = [
        'id_anunt',
        'nume',
        'prenume',
        'telefon',
        'email',
        'adresa',
        'cadastru',
        'intabulare',
        'observatii',
        'certificat_energetic',
        'poze_map',
        'bloc_reabilitat'
    ];

}
