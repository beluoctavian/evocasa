<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Anunt extends Model {

    protected $table = 'anunts';

    protected $fillable = [
        'titlu',
        'tip',
        'categorie',
        'nr_camere',
        'oras',
        'cartier',
        'zona',
        'pret',
        'pret_vechi',
        'cod',
        'descriere',
        'status',
        'first_page'
    ];

    public function hasStatus($status){
        $pos = strpos($this->status, $status);
        return $pos === false ? 0 : 1;
    }

}
