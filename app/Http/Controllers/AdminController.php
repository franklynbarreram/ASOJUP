<?php

namespace App\Http\Controllers;
use App\Registro_listado ;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    //
    public function consulta(){
            $hola=Registro_listado::all();
            echo $hola;
    }
}
