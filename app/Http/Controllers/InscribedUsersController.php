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

use Illuminate\Support\Facades\Hash;
use App\Rules\CurrentPasswordCheckRule;

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

    /**
     * 
     */
    public function ajaxInhabilitate (Request $request, $id) {
        try {
            $inscribed = InscribedUser::find($id);

            $inscribed->active = false;
            $inscribed->save();

            return response()->json([
                'status'    =>  'success',
                'data'  =>  $inscribed
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  $e->getMessage()
            ]);
        }
    }

    public function edit_profile(Request $request, $id)
    {
        $inscrito = InscribedUser::find($id);
        return view('inscribed_users.edit',['inscrito'=>$inscrito]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_profile(Request $request)
    {

        try{
            $inscrito = InscribedUser::find($request->id); 
            $inscrito->update($request->all());
            $inscrito->save();

            return back()->withStatus(__('Datos actualizados correctamente.'));

        } catch(\Exception $e){
            return back()->with('ErrorSave', 'Ha ocurrido un error.');
        }
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password_profile(Request $request)
    {
        $messages = [
            'confirmed' => 'La confirmación de contraseña no coincide.',
            'different'=>'La nueva contraseña no puede ser igual a la anterior'
        ];

        $this->validate($request, [
            'old_password' => ['required'],
            'password' => ['required', 'confirmed', 'different:old_password'],
            'password_confirmation' => ['required'],
        ],$messages);


        $data = $request->all();
 
        $user = InscribedUser::find($request->id);
        if(!Hash::check($data['old_password'], $user->password)){
             return back()->with('ErrorSavePassword','La contraseña ingresada no coincide con la contraseña antigua');
        }else{
            try{
                
                $user->password = bcrypt($data['password']);
                $user->save();
                return back()->withPasswordStatus(__('Contraseña actualizada correctamente.'));
    
            } catch(\Exception $e){
                return back()->with('ErrorSavePassword', 'Ha ocurrido un error.');
            }
        }
       
    }
}
