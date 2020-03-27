<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscribedUser extends Model
{
    protected $table = 'inscribed_users';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'identification',
        'cicpc_id',
        'phone',
        'address',
        'active'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
