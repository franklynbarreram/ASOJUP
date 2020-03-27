<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeedType extends Model
{
    protected $table = 'needs_types';

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
