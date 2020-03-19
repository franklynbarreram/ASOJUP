<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sobrevivientes extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre','apellido','cedula','inscritos_id', 'direccion','cicpc_id','telefono'
     ];
 
     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
     protected $hidden = [
       
     ];
}
