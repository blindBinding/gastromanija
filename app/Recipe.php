<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Recipe extends Model
{
    //Ime tabele
    protected $table = 'recipes';
    //Primarni kljuc
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function kuhinja(){
        return $this->belongsTo('App\Kuhinja');
    }

    public function sastojak(){
        return $this->belongsTo('App\Sastojak');
    }

}
