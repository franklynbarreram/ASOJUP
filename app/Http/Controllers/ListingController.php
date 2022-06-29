<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\InscribedUser;
use App\Models\Listing;
use App\Models\ListingHistory;

class ListingController extends Controller
{
    /**
     * Both needs and requests are stored on the same Need model and divided by an extra foreign key.
     * 
     * @var string
     */
    const CLASSNAMES = [
        'needs' => 'App\Models\Need',
        'diseases' => 'App\Models\Need',
        'medicines' => 'App\Models\Medicine',
    ];

    /**
     * Asociative array to determine the querying output of the parameter sent
     * 
     * @var string[]
     */
    const QUERYNAMES = [
        'needs' => 'Solicitud',
        'diseases' => 'Enfermedad',
        'medicines' => 'Medicina',
    ];

    /**
     * Disease relation type database identificator
     * 
     * @var integer
     */
    const DISEASE_TYPE_ID = 1;

    /**
     * Request relation type database identificator
     * 
     * @var integer
     */
    const REQUEST_TYPE_ID = 2;

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

    public function history(Request $request)
    {
        $listing = Listing::find($request->listingId);

        $inscribedUsers = [];

        if ($request->inscribedIds) {
            $userIds = explode(',', $request->inscribedIds[0]);
            $inscribedUsers = $this->retrieveUsers($listing->id, $request->type, $userIds);
        }
        

        return view('admin.listings.history', [
            'listing' => $listing,
            'inscribedUsers' => $inscribedUsers,
        ]);
    }

    /**
     * 
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
            return $this->retrieveUsers(
                $request->listingId,
                $request->type,
            );
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  $e->getMessage()
            ], 500);
        }
    }

    public function deleteItem(Request $request)
    {
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

    public function getInscribedTable(Request $request)
    {
        $users = $this->search($request);

        return view('layouts.templates.inscribed-users-table', [
            'users' => $users,
            'type' => $request->type,
        ])->render();
    }

    public function addInscribedUsersToListing(Request $request)
    {
        $request->listingId = 1;

        return redirect()->route('listings.history', [
            'listingId' => 1,
            'userIds' => $request->inscribedIds[0]
        ]);
    }

    /**
     * $type = 'diseases', 'medicines', 'requests'
     * 
     * 'diseases' = Enfermedades
     * 'needs' = Necesidad
     * 'medicines' = Medicinas, no need to extra join the query
     */
    private function retrieveUsers($listingId, $type = NULL, $userIds = NULL)
    {
        DB::statement(DB::raw('set @row:=0'));

        $queryType = self::CLASSNAMES[$type];

        $requirementType = self::QUERYNAMES[$type];

        $selectionTypeName = $type == 'diseases' || $type == 'needs'
            ? 'needs'
            : 'medicines';

        $query = InscribedUser::select([
            DB::raw('@row:=@row+1 as row'),
            'inscribed_users.id',
            'inscribed_users.name',
            'inscribed_users.surname',
            'inscribed_users.identification',
            'inscribed_users.cicpc_id',
            'inscribed_users.phone',
            'inscribed_users.email',
            'inscribed_users_relationships.entity_id',
            'inscribed_users_relationships.entity_type',
            "$selectionTypeName.name AS item_name",
            DB::raw("'$requirementType' AS requirement_type")
        ])->join(
            'inscribed_users_relationships', 'inscribed_users.id', '=', 'inscribed_users_relationships.inscribed_user_id'
        );

        // Do the join separation depending on the types sent via parameter
        if ($type == 'diseases' || $type == 'needs') {
            $needTypeId = $type === 'diseases' ? self::DISEASE_TYPE_ID : self::REQUEST_TYPE_ID;

            $query->join(
                'needs', 'inscribed_users_relationships.entity_id', '=', 'needs.id'
            )->where(
                'needs.need_type_id', $needTypeId 
            );
        } else {
            // If none of the both were sent, just do the join relation with medicines table
            $query->join(
                'medicines', 'inscribed_users_relationships.entity_id', '=', 'medicines.id'
            );
        }

        // Extract relations by the entity class type string sent
        $query->where(
            'inscribed_users_relationships.entity_type', $queryType
        );

        if ($userIds) {
            $query->whereIn(
                'inscribed_users.id', $userIds
            );
        }

        return $query->get();
    }
}
