<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\InscribedUser;
use App\Models\Listing;
use App\Models\listingHistory;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listings = Listing::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.listings.index', [
            'listings'  =>  $listings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.listings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listing = Listing::create([
            'description'   =>  $request->description,
            'date'          =>  $request->date,
            'user_id'       =>  Auth::user()->id,
        ]);

        return redirect()->route(
            'listings.index'
        )->with(
            'notification', 'Se ha creado el listado satisfactoriamente'
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
        //
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
        //
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

    public function history ($listing_id) {
        
        $listing = Listing::find($listing_id);
        
        return view('admin.listings.history', [
            'listing'   =>  $listing
        ]);
    }

    public function search (Request $request) {
        try {
            $users = InscribedUser::select(
                'inscribed_users.id',
                'inscribed_users.name', 'inscribed_users.surname', 'inscribed_users.identification',
                'inscribed_users.cicpc_id', 'inscribed_users.phone', 'inscribed_users.email',
                'needs.id as disease_id', 'needs.name as disease_name'
            )->with([
                'medicines' => function ($query) {
                    $query->selectRaw(
                        "medicines.id, medicines.name, " .
                        "CONCAT(medicines.concentration, medicines_units.short_name) as spec, " .
                        "medicines_forms.name as pres"
                    )->join(
                        'medicines_units', 'medicines.medicine_unit_id', '=', 'medicines_units.id'
                    )->join(
                        'medicines_forms', 'medicines.medicine_form_id', '=', 'medicines_forms.id'
                    );
                }
            ])->join(
                'inscribed_users_needs', 'inscribed_users.id', '=', 'inscribed_users_needs.inscribed_user_id'
            )->join(
                'needs', 'inscribed_users_needs.need_id', '=', 'needs.id'
            )->where(
                'needs.need_type_id', 1
            )->where(
                'needs.name', 'like', '%' . $request->disease . '%'
            )->get();

            return $users;

        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  $e->getMessage()
            ], 500);
        }
    }
}
