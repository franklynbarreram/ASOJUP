<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro_listado extends Model
{
    //
    public $table = "registro_listado";
    protected $fillable = [
        'necesidad_inscrito_id','listado_id'
     ];
}
