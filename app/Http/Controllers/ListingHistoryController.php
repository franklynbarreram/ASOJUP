<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Barryvdh\DomPDF\Facade as PDF;

class ListingHistoryController extends Controller
{
    public function saveListingUsersData(Request $request, $listingId)
    {
        $listing = Listing::find($listingId);
        $listing->inscribed_users_data = $request->data;
        $listing->save();

        return response()->json([
            'success' => true,
            'message' => 'Listing JSON data saved successfully',
        ], 200);
    }

    public function pdfGenerate(Request $request, $listingId)
    {
        $listing = Listing::find($listingId);
        $data = [
            'description'=> $listing -> description,
            'date'=> $listing -> date,
            'inscribedUsers'=> json_decode($listing -> inscribed_users_data),
            'created_at'=> $listing -> created_at,
        ];
        //return view('pdf.index', $data);
        $pdf = PDF::loadView('pdf.index', $data);

        return $pdf->download('list.pdf');
    }
}
