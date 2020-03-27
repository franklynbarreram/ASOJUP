<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    protected $table = 'needs';

    protected $fillable = [
        'name', 'description', 'need_type_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
