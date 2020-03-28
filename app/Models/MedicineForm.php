<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineForm extends Model
{
    protected $table = 'medicines_forms';

    protected $fillable = [
        'name', 'short_name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
