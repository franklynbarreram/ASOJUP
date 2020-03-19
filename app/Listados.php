<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listados extends Model
{
    //
    public $table = "listados";
    protected $fillable = [
        'descripcion'
     ];
}
