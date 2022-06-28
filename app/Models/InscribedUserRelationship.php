<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InscribedUserRelationship extends Model
{
    protected $table = 'inscribed_users_relationships';

    protected $fillable = [
        'inscribed_user_id',
        'entity_id',
        'entity_type',
    ];

    public $timestamps = FALSE;

    
    public function entity()
    {
        return $this->morphTo();
    }
}
