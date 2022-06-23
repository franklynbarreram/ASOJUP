<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\InscribedUser;
use App\Models\Listing;
use App\Models\ListingHistory;

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
         $listing = Listing::find(1);
        $listings = Listing::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.listings.edit', [
            'listing'  =>  $listing
        ]);
      
       /*  return view('admin.listings.edit', ['listing' =>  $listing]);  */
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
        return $id;
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

    /**
     *   {title:"Nombre Completo", field:"fullname", width: 175},
     *   {title:"Cédula", field:"identification"},
     *   {title:"Teléfono", field:"phone_number"},
     *   {title:"Enfermedad", field:"disease"},
     *   {title:"Medicina", field:"medicine_name"},
     *   {title:"Presentación", field:"medicine_presentation"},
     *   {title:"Cantidad", field:"medicine_quantity"},
     *   {title:"Medicine User Id", field:"user_medicine_id"}
    */
    public function currentItems($listing_id)
    {
        try {
            $items = ListingHistory::selectRaw(
                "
                CONCAT(inscribed_users.name, CONCAT(' ', inscribed_users.surname)) AS fullname,
                inscribed_users.identification,
                inscribed_users.phone AS phone_number,
                needs.name as disease,
                inscribed_users_medicines.id as user_medicine_id,
                medicines.id AS medicine_id,
                medicines.name AS medicine_name,
                CONCAT(medicines_forms.name, CONCAT(' ', CONCAT(medicines.concentration, medicines_units.short_name))) AS medicine_presentation,
                listings_history.amount as medicine_quantity
                "
            )->join(
                'inscribed_users_medicines', 'listings_history.inscribed_user_medicine_id', '=', 'inscribed_users_medicines.id'
            )->join(
                'inscribed_users', 'inscribed_users_medicines.inscribed_user_id', '=', 'inscribed_users.id'
            )->join(
                'inscribed_users_needs', 'inscribed_users.id', '=', 'inscribed_users_needs.inscribed_user_id'
            )->join(
                'needs', 'inscribed_users_needs.need_id', '=', 'needs.id'
            )->join(
                'medicines', 'inscribed_users_medicines.medicine_id', '=', 'medicines.id'
            )->join(
                'medicines_units', 'medicines.medicine_unit_id', '=', 'medicines_units.id'
            )->join(
                'medicines_forms', 'medicines.medicine_form_id', '=', 'medicines_forms.id'
            )->where(
                'listing_id', $listing_id
            )->where(
                'needs.need_type_id', 1
            )->get();

            return $items;
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $users = InscribedUser::select(
                'inscribed_users.id',
                'inscribed_users.name',
                'inscribed_users.surname',
                'inscribed_users.identification',
                'inscribed_users.cicpc_id',
                'inscribed_users.phone',
                'inscribed_users.email',
                'needs.id as disease_id',
                'needs.name as disease_name'
            )->with([
                // Watch the "inscribed_user_need" column item, might change for an polymorphic column
                'medicines' => function ($query) use ($request) {
                    $query->selectRaw("
                        medicines.id,
                        medicines.name,
                        CONCAT(medicines.concentration, medicines_units.short_name) as spec,
                        inscribed_users_medicines.id as user_medicine_id,
                        medicines_forms.name as pres,
                        (
                            IF(
                                (
                                SELECT inscribed_user_need
                                FROM listings_history 
                                WHERE inscribed_users_medicines.id = inscribed_user_need 
                                AND listing_id = $request->listingId
                            ) > 0
                            , true, false)
                        ) AS selected
                    ")->join(
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

    public function pickItem(Request $request)
    {
        try {

            $listing_item = ListingHistory::where(
                'listing_id', $request->listing_id
            )->where(
                'inscribed_user_medicine_id', $request->inscribed_user_medicine_id
            )->first();

            if ($listing_item) {
                $listing_item->delete();

                return response()->json([
                    'status'    =>  'success',
                    'message'   =>  'Item has been succesfully deleted',
                    'deleted'   =>  true
                ], 200);
            }

            $listing_item = ListingHistory::create([
                'listing_id'                    =>  $request->listing_id,
                'inscribed_user_medicine_id'    =>  $request->inscribed_user_medicine_id,
                'amount'    => 1
            ]);

            return response()->json([
                'status'    =>  'success',
                'message'   =>  'Item has been succesfully added',
                'deleted'   =>  false
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  $e->getMessage()
            ], 500);
        } 
    }

    public function updateAmount (Request $request) {
        try {

            $listing_item = ListingHistory::where([
                'listing_id'                    =>  $request->listing_id,
                'inscribed_user_medicine_id'    =>  $request->inscribed_user_medicine_id
            ])->first();

            $listing_item->amount = $request->amount;
            $listing_item->save();

            return response()->json([
                'status'    =>  'success',
                'message'   =>  'item amount succesfully updated'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  $e->getMessage()
            ], 500);
        }
    }

    public function deleteItem (Request $request) {
        try {

            $listing_item = ListingHistory::where([
                'listing_id'                    =>  $request->listing_id,
                'inscribed_user_medicine_id'    =>  $request->inscribed_user_medicine_id
            ])->first();

            $listing_item->delete();

            return response()->json([
                'status'    =>  'success',
                'message'   =>  'Item found!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  $e->getMessage()
            ], 500);
        }
    }
}
