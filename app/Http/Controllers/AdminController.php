<?php

namespace App\Http\Controllers;
use App\Necesidades_inscritos ;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    //
    public function consulta(){
            $hola=Necesidades_inscritos::all();
            echo $hola;
    }
}
