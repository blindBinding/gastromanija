<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Sastojak extends Model
{
   public function recipe()
   {
       return $this->hasMany('App\Recipe');
   }

   protected $casts = [
    'sastojci_id' => 'array',
];
}