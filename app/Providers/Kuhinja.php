<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kuhinja extends Model
{
   public function recipe()
   {
       return $this->hasOne('App\Recipe');
   }

}