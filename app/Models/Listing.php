<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $table = 'listings';

    protected $fillable = [
        'description', 'date', 'user_id', 'inscribed_users_data'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function user () {
        return $this->belongsTo('App\User', 'user_id');
    }
}
