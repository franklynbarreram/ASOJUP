<?php

namespace App\Http\Controllers\Medicines;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Medicine;
use App\Models\MedicineForm;
use App\Models\MedicineUnit;
use Illuminate\Support\Facades\Auth;

use App\Models\Permission;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();
        if (isset($request->search)) {
            $medicines = Medicine::search($request->search)->paginate(10);
        } else {
            $medicines = Medicine::orderBy('name', 'asc')->paginate(10);
        }

        return view('admin.medicines.index', [
            'medicines' =>  $medicines,
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
        $med_forms = MedicineForm::all();
        $med_units = MedicineUnit::all();
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();
        return view('admin.medicines.create', [
            'med_forms' =>  $med_forms,
            'med_units' =>  $med_units,
            'permission_delegated' => $permission_delegated,
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
            /*
            $validator = \Validator::make($request->all(), [
                'name'          =>  'required|string',
                'box_quantity'  =>  'required|numeric',
                'concentration' =>  'required|numeric',
                'medicine_form_id'  =>  'required|numeric',
                'medicine_unit_id'  =>  'required'
            ]);

            if (!$validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput($request->input())->with('notification_error', '¡Ha ocurrido un error!');
            }
            */
            $medicine = Medicine::create($request->except('_token'));

            return redirect()->route('medicines.index')->with(
                'notification',
                'Se ha creado la medicina exitosamente.'
            )->with(
                'success',
                true
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
        return Medicine::find($id)->unit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicine = Medicine::find($id);
        $med_forms = MedicineForm::all();
        $med_units = MedicineUnit::all();
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();
        return view('admin.medicines.edit', [
            'medicine'  =>  $medicine,
            'med_forms' =>  $med_forms,
            'med_units' =>  $med_units,
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
        /*
        $validator = \Validator::make($request->all(), [
            'name'          =>  'required|string',
            'box_quantity'  =>  'required|numeric',
            'concentration' =>  'required|numeric',
            'medicine_form_id'  =>  'required|numeric',
            'medicine_unit_id'  =>  'required'
        ]);

        if (!$validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input())->with('notification_error', '¡Ha ocurrido un error!');
        }
        */

        $medicine = Medicine::find($id);

        $medicine->update($request->except(['_token', '_method']));

        return redirect()->route('medicines.index')->with(
            'notification',
            'Se ha editado la medicina exitosamente.'
        )->with(
            'success',
            true
        );
    }

    public function delete(Request $request)
    {
        //
        try {

            $deletedRows = Medicine::where('id', $request->id)->delete();

            return redirect()->route('medicines.index')->with(
                'notification',
                'Se ha eliminado la medicina exitosamente.'
            )->with(
                'success',
                true
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


    /**
     * 
     */
    public function ajaxStore(Request $request)
    {
        try {

            $medicine = Medicine::create($request->all());

            return response()->json([
                'status'    =>  'success',
                'data'      =>  [
                    'id'    =>  $medicine->id,
                    'name'  =>  $medicine->fullName
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
