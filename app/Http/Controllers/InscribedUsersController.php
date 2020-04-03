<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\InscribedUser;
use App\Models\InscribedUserNeed;
use App\Models\InscribedUserMedicine;

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
    public function index (Request $request)
    {
        $inscribed_users = InscribedUser::all();

        return view ('admin.inscribed_users.index', [
            'inscribed_users'   =>  $inscribed_users
        ]);
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
        $inscribed = InscribedUser::create([
            'name'      =>  $request->name,
            'surname'   =>  $request->surname,
            'email'     =>  $request->email,
            'phone'     =>  $request->phone,
            'identification'    =>  $request->identification,
            'cicpc_id'          =>  $request->cicpc_id,
            'active'            =>  true,
            'address'           =>  $request->address
        ]);
        
        //Medicines
        if (isset($request->medicines)) {
            foreach ($request->medicines as $med_id) {
                InscribedUserMedicine::create([
                    'inscribed_user_id' =>  $inscribed->id,
                    'medicine_id'       =>  $med_id
                ]);
            }
        }

        //Benefits
        if (isset($request->benefits)) {
            foreach ($request->benefits as $need_id) {
                InscribedUserNeed::create([
                    'inscribed_user_id' =>  $inscribed->id,
                    'need_id'       =>  $need_id
                ]);
            }
        }

        //Diseases
        if (isset($request->diseases)) {
            foreach ($request->diseases as $need_id) {
                InscribedUserNeed::create([
                    'inscribed_user_id' =>  $inscribed->id,
                    'need_id'       =>  $need_id
                ]);
            }
        }

        return redirect()->route('inscribedUsers.index')->with(
            'notification', 'Se ha creado el inscrito satisfactoriamente.'
        )->with(
            'success', true
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit ($id)
    {
        $inscribed = InscribedUser::find($id);

        $diseases = Need::diseases()->get();
        $benefits = Need::benefits()->get();
        $medicines = Medicine::orderBy('name', 'asc')->get();

        $med_units = MedicineUnit::orderBy('name', 'asc')->get();
        $med_forms = MedicineForm::orderBy('name', 'asc')->get();

        return view('admin.inscribed_users.edit', [
            'inscribed' =>  $inscribed,
            'diseases'  =>  $diseases,
            'benefits'  =>  $benefits,
            'medicines' =>  $medicines,
            'med_units' =>  $med_units,
            'med_forms' =>  $med_forms
        ]);
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
        $inscribed = InscribedUser::find($id);

        $inscribed->update([
            'name'      =>  $request->name,
            'surname'   =>  $request->surname,
            'email'     =>  $request->email,
            'phone'     =>  $request->phone,
            'identification'    =>  $request->identification,
            'cicpc_id'          =>  $request->cicpc_id,
            'active'            =>  true,
            'address'           =>  $request->address
        ]);


        //Medicines
        if (isset($request->medicines)) {
            InscribedUserMedicine::where('inscribed_user_id', $inscribed->id)->delete();;

            foreach ($request->medicines as $med_id) {
                InscribedUserMedicine::create([
                    'inscribed_user_id' =>  $inscribed->id,
                    'medicine_id'       =>  $med_id
                ]);
            }
        }

        //Benefits
        if (isset($request->benefits)) {

            //Delete benefits registered previously
            InscribedUserNeed::where(
                'inscribed_user_id', $inscribed->id
            )->whereIn(
                'need_id', $inscribed->benefitsIds()
            )->delete();

            foreach ($request->benefits as $need_id) {
                InscribedUserNeed::create([
                    'inscribed_user_id' =>  $inscribed->id,
                    'need_id'       =>  $need_id
                ]);
            }
        }

        //Diseases
        if (isset($request->diseases)) {

            //Delete diseases registered previously
            InscribedUserNeed::where(
                'inscribed_user_id', $inscribed->id
            )->whereIn(
                'need_id', $inscribed->diseasesIds()
            )->delete();

            foreach ($request->diseases as $need_id) {
                InscribedUserNeed::create([
                    'inscribed_user_id' =>  $inscribed->id,
                    'need_id'       =>  $need_id
                ]);
            }
        }

        return redirect()->back()->with(
            'notification', 'Se ha editado el inscrito satisfactoriamente.'
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
    public function destroy ($id)
    {
        //
    }
}
