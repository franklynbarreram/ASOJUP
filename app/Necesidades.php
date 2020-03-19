<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Necesidades extends Model
{
    //
    public $table = "necesidades";
    protected $fillable = [
        'nombre','descripcion','tipo_necesidad_id'
     ];
 
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
     protected $hidden = [
       
     ];
}
