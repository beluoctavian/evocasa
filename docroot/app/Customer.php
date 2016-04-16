<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    protected $table = 'customers';

    protected $fillable = [
        'nume',
        'prenume',
        'telefon',
        'email',
        'buget',
        'tip_plata',
        'numar_camere_cautate',
        'oras',
        'cartier',
        'zona',
        'observatii'
    ];

}
