<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Zone;
use App\User;
use Validator;
use Illuminate\Support\Facades\Hash;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        $zones = Zone::get();
        try {
            //code...
            return view('admin.delegates.create',['zones' =>  $zones]);
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
       
    }

    public function store(Request $request)
    {   
       
         try {
             $delegates = User::create([
                'name'      =>  $request->name,
                'email'      =>  $request->email,
                'password'      =>   Hash::make($request->password),
                'zone_id'      =>  $request->zone_id,
                'role_id'      =>  2,
            ]); 
            $delegates = User::where('role_id', 2)->get();
            return redirect()->route(
                'delegates.index', [ 'delegates' =>  $delegates ]
            )->with(
                'notification', 'Se ha creado el delegado satisfactoriamente'
            )->with(
                'success', true
            );
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        } 
    }

    public function index (Request $request) {

        $delegates = User::where('role_id', 2)->get();

        return view('admin.delegates.index', [
            'delegates' =>  $delegates
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delegate = User::find($id);
        $zones = Zone::all();

        return view('admin.delegates.edit', [
            'delegate'  =>  $delegate,
            'zones' =>  $zones
        ]);
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
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'email',
                'password' => 'confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors(
                    $validator
                )->withInput(
                    $request->input()
                )->with(
                    'notification', 'No se ha podido editar al delegado'
                )->with(
                    'success', false
                );
            }

            $delegate = User::find($id);

            $delegate->update([
                'name'  =>  $request->name,
                'email' =>  $request->email,
                'password'  =>  bcrypt($request->password),
                'zone_id'   =>  $request->zone_id
            ]);

            return redirect()->route(
                'delegates.index'
            )->with(
                'notification', 'Se ha editado al delegado'
            )->with(
                'success', true
            );

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $delegate = User::find($id);

        $delegate->delete();
        
        return redirect()->route(
            'delegates.index'
        )->with(
            'notification', 'Se ha eliminado al delegado satisfactoriamente'
        )->with(
            'success', true
        );  
    }

    public function eliminar (Request $request)
    {
        //
        $delegate = User::find($request["id_delegado"]);
       
         try{
            $delegate->delete();
            return back()->with('notification','El delegado fue eliminado exitosamente!')->with(
                'success', true
            );
        }catch(\Exception $e){
            return back()->with('error',$e);
        } 
    }
}
