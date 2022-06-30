<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'name',
        'description',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function inscribedUsers()
    {
        return $this->morphToMany('App\Models\InscribedUser', 'inscribed_users_relationships');
    }
}
