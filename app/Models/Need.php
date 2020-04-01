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

    /**
     * Scopes the need model depending on the id.
     * 
     * @param nt_id references the need_type_id sent in the scope
     */
    public function scopeSearchById ($query, $nt_id) {
        return $query->where('need_type_id', $nt_id)->orderBy('name', 'asc');
    }

    public function scopeDiseases ($query) {
        return $query->where('need_type_id', 1)->orderBy('name', 'asc');
    }

    public function scopeBenefits ($query) {
        return $query->where('need_type_id', 2)->orderBy('name', 'asc');
    }
}
