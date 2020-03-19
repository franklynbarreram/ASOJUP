<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Necesidades_inscritos extends Model
{
    //
    public $table = "necesidades_inscritos";
    protected $fillable = [
        'inscrito_id','necesidad_id'
     ];
 
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
     protected $hidden = [
       
     ];
}
