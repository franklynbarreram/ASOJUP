<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscribedUser;
use Illuminate\Support\Facades\Hash;
use App\Rules\CurrentPasswordCheckRule;

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
        return view('inscribed_users.create');
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
