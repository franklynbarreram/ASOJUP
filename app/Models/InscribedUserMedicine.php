<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscribedUserMedicine extends Model
{
    protected $table = 'inscribed_users_medicines';

    protected $fillable = [
        'inscribed_user_id', 'medicine_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
