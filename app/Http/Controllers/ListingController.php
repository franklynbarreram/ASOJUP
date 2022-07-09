<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\InscribedUser;
use App\Models\Listing;
use App\Models\ListingHistory;
use App\Models\Permission;

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
        $admin = Auth::user();
        $listings = Listing::orderBy('created_at', 'desc')->paginate(10);
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();

        if ($permission_delegated != 0 && $admin->role_id == 2 || $admin->role_id == 1) {
            return view('admin.listings.index', [
                'listings'  =>  $listings,
                'permission_delegated' => $permission_delegated
            ]);
        } else {
            $result = (new HomeController)->index();
            return $result;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Auth::user();
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();

        if ($permission_delegated != 0 && $admin->role_id == 2 || $admin->role_id == 1) {
            return view('admin.listings.create', ['permission_delegated' => $permission_delegated,]);
        } else {
            $result = (new HomeController)->index();
            return $result;
        }
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
            'notification',
            'Se ha creado el listado satisfactoriamente'
        )->with(
            'success',
            true
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

        $admin = Auth::user();
        $listing = Listing::find(1);
        $listings = Listing::orderBy('created_at', 'desc')->paginate(10);
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();
        if ($permission_delegated != 0 && $admin->role_id == 2 || $admin->role_id == 1) {
            return view('admin.listings.edit', [
                'listing'  =>  $listing,
                'listings'  =>  $listings,
                'permission_delegated' => $permission_delegated
            ]);
        } else {
            $result = (new HomeController)->index();
            return $result;
        }


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

    /**
     * 
     */
    public function history(Request $request)
    {
        $listing = Listing::find($request->listingId);
        $admin = Auth::user();
        $id = Auth::id();
        $permission_delegated = Permission::where([['status', '=', "Pendiente"], ['user_id', '=', $id]])->count();
        if ($permission_delegated != 0 && $admin->role_id == 2 || $admin->role_id == 1) {
            return view('admin.listings.history', [
                'listing'  =>  $listing,
                'permission_delegated' => $permission_delegated
            ]);
        } else {
            $result = (new HomeController)->index();
            return $result;
        }
    }

    /**
     * 
     */
    public function getInscribedTable(Request $request)
    {
        $users = $this->retrieveUsers(
            $request->type,
            $request->searchValue,
        );

        return view('layouts.templates.inscribed-users-table', [
            'users' => $users,
            'type' => $request->type,
            'selectedUsers' => $request->selectedUsers,
        ])->render();
    }

    public function getUsersTable(Request $request)
    {
        return $request->all();
    }

    /**
     * $type = 'diseases', 'medicines', 'requests'
     * 
     * 'diseases' = Enfermedades
     * 'needs' = Necesidad
     * 'medicines' = Medicinas, no need to extra join the query
     */
    private function retrieveUsers($type = NULL, $searchValue = '')
    {
        DB::statement(DB::raw('set @row:=0'));

        $requirementType = self::QUERYNAMES[$type];

        $selectionTypeName = $type == 'diseases' || $type == 'needs'
            ? 'needs'
            : 'medicines';

        $joiningTable = $type == 'medicines' ? 'inscribed_users_medicines' : 'inscribed_users_needs';

        $query = InscribedUser::select([
            DB::raw('@row:=@row+1 as row'),
            'inscribed_users.id',
            'inscribed_users.name',
            'inscribed_users.surname',
            'inscribed_users.identification',
            'inscribed_users.cicpc_id',
            'inscribed_users.phone',
            'inscribed_users.email',
            "$selectionTypeName.name AS item_name",
            "$selectionTypeName.id AS item_id",
            DB::raw("'$requirementType' AS requirement_type"),
        ])->join(
            $joiningTable,
            'inscribed_users.id',
            '=',
            "$joiningTable.inscribed_user_id"
        );

        // Do the join separation depending on the types sent via parameter
        if ($type == 'diseases' || $type == 'needs') {
            $needTypeId = $type === 'diseases' ? self::DISEASE_TYPE_ID : self::REQUEST_TYPE_ID;

            $query->join(
                'needs',
                "$joiningTable.need_id",
                '=',
                'needs.id'
            )->where(
                'needs.need_type_id',
                $needTypeId
            );
        } else {
            // If none of the both were sent, just do the join relation with medicines table
            $query->join(
                'medicines',
                "$joiningTable.medicine_id",
                '=',
                'medicines.id'
            );
        }

        if ($searchValue) {
            $query->where(
                "$selectionTypeName.name",
                'like',
                "%$searchValue%"
            );
        }

        // if ($userIds) {
        //     $query->whereIn(
        //         'inscribed_users.id', $userIds
        //     );
        // }

        return $query->get();
    }

    public function saveListingUsersData(Request $request, $listingId)
    {
        $listing = Listing::find($listingId);
        $listing->inscribed_users_data = $request->data;
        $listing->save();

        return response()->json([
            'success' => true,
            'message' => 'Listing JSON data saved successfully',
            'listing' => $listing,
            'data' => $request->data,
        ], 200);
    }
}
