<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class InscribedUser extends Authenticatable
{
    protected $table = 'inscribed_users';

    protected $fillable = [
        'name',
        'surname',
        'password',
        'email',
        'identification',
        'cicpc_id',
        'phone',
        'address',
        'active'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];


    /**-------- Relations ------ */
    public function medicines () {
        return $this->belongsToMany('App\Models\Medicine', 'inscribed_users_medicines');
    }

    public function needs () {
        return $this->belongsToMany('App\Models\Need', 'inscribed_users_needs');
    }

    public function survivors () {
        return $this->hasMany('App\Models\Survivor', 'inscribed_user_id');
    }

    /**-------- Mutators ------- */
    public function getFullNameAttribute () {
        return $this->name . ' ' . $this->surname; 
    }

    /**-------- Scopes ----------*/
    /**
     * Get an array with only diseases ids
     */
    public function scopeDiseasesIds ($query, $id = null) {
        return $query->select(
            'needs.id'
        )->join(
            'inscribed_users_needs', 'inscribed_users.id', '=', 'inscribed_users_needs.inscribed_user_id' 
        )->join(
            'needs', 'inscribed_users_needs.need_id', '=', 'needs.id'
        )->where(
            'inscribed_users_needs.inscribed_user_id', $this->id
        )->where(
            'needs.need_type_id', 1
        )->pluck(
            'needs.id'
        );
    }

    /**
     * Get an array with only benefits ids
     */
    public function scopeBenefitsIds ($query, $id = null) {
        return $query->select(
            'needs.id'
        )->join(
            'inscribed_users_needs', 'inscribed_users.id', '=', 'inscribed_users_needs.inscribed_user_id' 
        )->join(
            'needs', 'inscribed_users_needs.need_id', '=', 'needs.id'
        )->where(
            'inscribed_users_needs.inscribed_user_id', $this->id
        )->where(
            'needs.need_type_id', 2
        )->pluck(
            'needs.id'
        );
    }

    public function scopeDiseases ($query, $id = null) {
        return $query->select(
            'needs.id', 'needs.name', 'needs.description', 'needs.need_type_id'
        )->join(
            'inscribed_users_needs', 'inscribed_users.id', '=', 'inscribed_users_needs.inscribed_user_id' 
        )->join(
            'needs', 'inscribed_users_needs.need_id', '=', 'needs.id'
        )->where(
            'inscribed_users_needs.inscribed_user_id', $this->id
        )->where(
            'needs.need_type_id', 1
        )->get();
    }

    public function scopeBenefits ($query) {
        return $query->select(
            'needs.id', 'needs.name', 'needs.description', 'needs.need_type_id'
        )->join(
            'inscribed_users_needs', 'inscribed_users.id', '=', 'inscribed_users_needs.inscribed_user_id' 
        )->join(
            'needs', 'inscribed_users_needs.need_id', '=', 'needs.id'
        )->where(
            'inscribed_users_needs.inscribed_user_id', $this->id
        )->where(
            'needs.need_type_id', 2
        )->get();
    }

    public function scopeHasMedicine ($query, $medicine_id) {
        $result = $query->join(
            'inscribed_users_medicines', 'inscribed_users.id', '=', 'inscribed_users_medicines.inscribed_user_id'
        )->where(
            'inscribed_users_medicines.inscribed_user_id', $this->id
        )->where(
            'inscribed_users_medicines.medicine_id', $medicine_id
        )->get()->count();

        return isset($result) ? $result : null;
    }

    public function scopeHasDisease ($query, $disease_id) {
        $result = $query->select(
            'needs.id', 'needs.name', 'needs.description', 'needs.need_type_id'
        )->join(
            'inscribed_users_needs', 'inscribed_users.id', '=', 'inscribed_users_needs.inscribed_user_id' 
        )->join(
            'needs', 'inscribed_users_needs.need_id', '=', 'needs.id'
        )->where(
            'inscribed_users_needs.inscribed_user_id', $this->id
        )->where(
            'inscribed_users_needs.need_id', $disease_id
        )->where(
            'needs.need_type_id', 1
        )->get()->count();

        return isset($result) ? $result : null;
    }

    public function scopeHasBenefit ($query, $benefit_id) {
        $result = $query->select(
            'needs.id', 'needs.name', 'needs.description', 'needs.need_type_id'
        )->join(
            'inscribed_users_needs', 'inscribed_users.id', '=', 'inscribed_users_needs.inscribed_user_id' 
        )->join(
            'needs', 'inscribed_users_needs.need_id', '=', 'needs.id'
        )->where(
            'inscribed_users_needs.inscribed_user_id', $this->id
        )->where(
            'inscribed_users_needs.need_id', $benefit_id
        )->where(
            'needs.need_type_id', 2
        )->get()->count();

        return isset($result) ? $result : null;
    }
}
