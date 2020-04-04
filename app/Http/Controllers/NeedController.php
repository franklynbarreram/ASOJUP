<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Need;
use App\Models\NeedType;

class NeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index (Request $request)
    {
        $type = $request->type;
        $need_type = NeedType::find($type);

        $needs = Need::searchById($type)->paginate(10);

        $title = 'Listado de ' . $need_type->name . 'es';
        
        return view('admin.needs.index', [
            'type_id'   =>  $type,
            'title'     =>  $title,
            'needs'     =>  $needs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create (Request $request)
    {
        $type = $request->type;
        $need_type = NeedType::find($type);
        $title = 'Nueva ' . $need_type->name;

        return view('admin.needs.create', [
            'type_id'   =>  $type,
            'title'     =>  $title
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
        /*
        $validator = \Validator::make($request->all(), [
            'name'          =>  'required',
            'description'   =>  'required',
        ]);

        if (!$validator->fails()) {
            return redirect()->back()->withErrors(
                $validator
            )->withInput(
                $request->input()
            )->with(
                'notification', 'No se ha podido registrar'
            )->with(
                'success', false
            );
        }
        */
        //return $request->except('_token');
        $need = Need::create($request->except('_token'));

        return redirect()->route(
            'needs.index', ['type' => $request->need_type_id]
        )->with(
            'notification', 'Se ha registrado la necesidad satisfactoriamente'
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
        $need = Need::find($id);
        $need_type = NeedType::find($need->need_type_id);
        $title = 'Editar ' . $need_type->name;

        return view('admin.needs.edit', [
            'need'  =>  $need,
            'title' =>  $title
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
            'name'          =>  'required',
            'description'   =>  'required',
        ]);

        if (!$validator->fails()) {
            return redirect()->back()->withErrors(
                $validator
            )->withInput(
                $request->input()
            )->with(
                'notification', 'No se ha podido registrar'
            )->with(
                'success', false
            );
        }
        */

        $need = Need::find($id);

        $need->name = $request->name;
        $need->description = $request->description;
        $need->save();

        return redirect()->route(
            'needs.index', ['type' => $need->need_type_id]
        )->with(
            'notification', 'Se ha editado la necesidad satisfactoriamente'
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
    public function delete(Request $request)
    {
        
        $deletedRows = Need::where('id',$request->id)->delete(); 
       

        return redirect()->route(
            'needs.index', ['type' => $request->type]
        )->with(
            'notification', 'Se ha eliminado la necesidad satisfactoriamente'
        )->with(
            'success', true
        );  
    }

    public function ajaxStore (Request $request)  {
        try {
            $need = Need::create($request->all());
            
            return response()->json([
                'status'    =>  'success',
                'data'      =>  $need
            ]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
