<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\InscribedUser;
use App\Models\Listing;
use DateTime;
use App\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dt = new DateTime();
        $dt->format('Y-m-d');

        $dtMonth = new DateTime();
        $dtMonth->modify('-1 months')->format('Y-m-d');


        $inscribed = InscribedUser::where([['created_at', '<=', $dt], ['created_at', '>=', $dtMonth]])->count();

        $permissions = Permission::where('status', '=', "Pendiente")->count();
        $listings = Listing::where([['created_at', '<=', $dt], ['created_at', '>=', $dtMonth]])->count();


        $role_id_user = Auth::user()->role_id;
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();

        return view('admin.dashboard', [
            'inscribed' => $inscribed,
            'permissions' => $permissions,
            'listings' => $listings,
            'permission_delegated' => $permission_delegated,
        ]);
    }
}
