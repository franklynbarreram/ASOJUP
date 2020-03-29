<?php

namespace App\Http\Controllers\Medicines;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\MedicineUnit;

class MedicineUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index ()
    {
        $units = MedicineUnit::orderBy('name', 'asc')->paginate(15);

        return view('admin.medicines.units.index', [
            'units' =>  $units
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        return view('admin.medicines.units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = ucwords($request->name);
        $short_name = $request->short_name;

        $med_unit = MedicineUnit::create([
            'name'  =>  $name,
            'short_name'    =>  strtolower($short_name)
        ]);

        return redirect()->route('units.index', [
            'notification'  =>  'Se ha creado la unidad de concentración exitosamente',
            'success'       =>  true  
        ]);
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
        $med_unit = MedicineUnit::find($id);

        return view('admin.medicines.units.edit', [
            'med_unit'  =>  $med_unit
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
        $med_unit = MedicineUnit::find($id);

        $name = ucwords($request->name);
        $short_name = strtoupper($request->short_name);

        $med_unit->name = $name;
        $med_unit->short_name = $short_name;

        $med_unit->save();

        return redirect()->route('units.index')->with(
            'notification', 'Se ha editado la unidad de concentración exitosamente.'
        )->with(
            'success', true
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
        //
    }
}
