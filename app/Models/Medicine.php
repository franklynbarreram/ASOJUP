<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';

    protected $fillable = [
        'name', 'concentration', 'box_quantity', 'medicine_form_id', 'medicine_unit_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
