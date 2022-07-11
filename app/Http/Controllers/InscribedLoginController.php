<?php

namespace App\Http\Controllers;

use App\Models\InscribedUser;
use Illuminate\Http\Request;

class InscribedLoginController extends Controller
{
    //

    public function index() {
        return view('auth.loginInscribed');
    }

    public function InscribedDashboard() {
        return view('inscribed_users.dashboard');
    }
}
