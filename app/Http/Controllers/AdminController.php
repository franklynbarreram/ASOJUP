<?php

namespace App\Http\Controllers;
use App\Admins ;
use App\Delegado;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function consulta(){
            $hola=Admins::all();
            echo $hola;
    }
}
