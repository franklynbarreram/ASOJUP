<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineUnit extends Model
{
    protected $table = 'medicines_units';

    protected $fillable = [
        'name', 'short_name'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];
}
