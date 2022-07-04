<?php

namespace App\Http\Controllers\Medicines;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\MedicineForm;
use Illuminate\Support\Facades\Auth;

use App\Models\Permission;

class MedicineFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $forms = MedicineForm::orderBy('id', 'asc')->paginate(15);
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();
        return view('admin.medicines.forms.index', [
            'forms' =>  $forms,
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
        return view('admin.medicines.forms.create');
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
        $short_name = strtoupper($request->short_name);

        $med_form = MedicineForm::create([
            'name'  =>  $name,
            'short_name'    =>  $short_name
        ]);

        return redirect()->route('forms.index', [
            'notification'  =>  'Se ha creado la forma farmacéutica exitosamente',
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
        $med_form = MedicineForm::find($id);
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();
        return view('admin.medicines.forms.edit', [
            'med_form'  =>  $med_form,
            'permission_delegated' => $permission_delegated,
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
        $med_form = MedicineForm::find($id);

        $name = ucwords($request->name);
        $short_name = strtoupper($request->short_name);

        $med_form->name = $name;
        $med_form->short_name = $short_name;

        $med_form->save();

        return redirect()->route('forms.index')->with(
            'notification',
            'Se ha editado la forma farmacéutica exitosamente.'
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
    public function delete(Request $request)
    {
        //
        $deletedRows = MedicineForm::where('id', $request->id)->delete();
        return redirect()->route('forms.index')->with(
            'notification',
            'Se ha editado la forma farmacéutica exitosamente.'
        )->with(
            'success',
            true
        );
    }
}
