<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

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
}
