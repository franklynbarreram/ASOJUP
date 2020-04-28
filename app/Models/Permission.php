<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'description', 'user_id', 'status'
    ];

    public function user () {
        return $this->belongsTo('App\User');
    }
}
