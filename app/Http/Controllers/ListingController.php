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
            return InscribedUser::ByDisease();
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  'failed',
                'message'   =>  $e->getMessage()
            ], 500);
        }
    }
}
