<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\InscribedUser;

use App\Models\Need;
use App\Models\Medicine;
use App\Models\MedicineForm;
use App\Models\MedicineUnit;

class InscribedUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        $diseases = Need::diseases()->get();
        $benefits = Need::benefits()->get();
        $medicines = Medicine::orderBy('name', 'asc')->get();

        $med_units = MedicineUnit::orderBy('name', 'asc')->get();
        $med_forms = MedicineForm::orderBy('name', 'asc')->get();

        return view('admin.inscribed_users.create', [
            'diseases'  =>  $diseases,
            'benefits'  =>  $benefits,
            'medicines' =>  $medicines,
            'med_units' =>  $med_units,
            'med_forms' =>  $med_forms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
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
    public function update (Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
        //
    }
}
