<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survivor extends Model
{
    protected $table = 'survivors';

    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'identification', 'address', 'inscribed_user_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /** Relations */
    public function inscribedUser () {
        return $this->belongsTo('App\Models\InscribedUser', 'inscribed_user_id');
    }

    /**Mutators */
    public function getFullNameAttribute () {
        return $this->name . ' ' . $this->surname;
    }
}
