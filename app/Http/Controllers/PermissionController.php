<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Permission;

use App\Http\Controllers\HomeController;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user();

        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();


        if ($admin->role_id == 1) {
            $permissions = Permission::orderBy('created_at', 'desc')->get();
        } else {
            $permissions = Permission::where('user_id', $admin->id)->orderBy('created_at', 'desc')->get();
        }

        return view('admin.permissions.index', [
            'permissions'   =>  $permissions,
            'permission_delegated' => $permission_delegated,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();


        return view('admin.permissions.create', ['permission_delegated' => $permission_delegated,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = Permission::create([
            'description'   =>  $request->description,
            'status'        =>  'Pendiente',
            'user_id'       =>  Auth::user()->id
        ]);

        return redirect()->route(
            'permissions.index'
        )->with(
            'notification',
            'Se ha solicitado el permiso satisfactoriamente'
        )->with(
            'success',
            true
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        $permission->status = $request->status;

        $permission->save();

        return redirect()->route(
            'permissions.index'
        )->with(
            'notification',
            'Se ha actualizado el permiso satisfactoriamente'
        )->with(
            'success',
            true
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);

        $permission->status = 'Cancelado';
        $permission->save();

        return redirect()->route(
            'permissions.index'
        )->with(
            'notification',
            'Se ha cancelado el permiso satisfactoriamente'
        )->with(
            'success',
            true
        );
    }
}
