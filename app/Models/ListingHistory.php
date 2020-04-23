<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingHistory extends Model
{
    protected $table = 'listings_history';

    protected $fillable = [
        'ammount', 'inscribed_user_medicine_id', 'listing_id'
    ];
}
