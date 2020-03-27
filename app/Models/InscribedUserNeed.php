<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscribedUserNeed extends Model
{
    protected $table = 'inscribed_users_needs';

    protected $fillable = [
        'inscribed_user_id', 'need_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
