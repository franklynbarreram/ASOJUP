<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InscribedUser;
use App\Models\InscribedUserNeed;
use App\Models\InscribedUserMedicine;

use App\Models\Need;
use App\Models\Medicine;
use App\Models\MedicineForm;
use App\Models\MedicineUnit;

use App\Models\Survivor;

class SurvivorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $inscribed = InscribedUser::find($request->inscribed_id);

        return view('admin.inscribed_users.survivors.index', [
            'inscribed' =>  $inscribed
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $inscribed = InscribedUser::find($request->inscribed_id);

        return view('admin.inscribed_users.survivors.create', [
            'inscribed' =>  $inscribed
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        try {
            //Validator
            //return $request->except('_token');
            $survivor = Survivor::create($request->except('_token'));

            return redirect()->route(
                'survivors.index', ['inscribed_id' => $request->inscribed_user_id]
            )->with(
                'notification', 'Se ha creado el sobreviviente satisfactoriamente'
            )->with(
                'success', true
            );
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
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
        $survivor = Survivor::find($id);
        
        return view('admin.inscribed_users.survivors.edit', [
            'survivor'  =>  $survivor
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
            $survivor = Survivor::find($id);

            $survivor->update($request->except('_token', '_method'));

            return redirect()->route(
                'survivors.index', ['inscribed_id' => $survivor->inscribedUser->id]
            )->with(
                'notification', 'Se ha editado el sobreviviente satisfactoriamente'
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
    public function destroy($id)
    {
        //
    }
}
