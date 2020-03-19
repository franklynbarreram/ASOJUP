<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_necesidad extends Model
{
    public $table = "necesidades";
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre',
     ];
 
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
     protected $hidden = [
       
     ];
}
