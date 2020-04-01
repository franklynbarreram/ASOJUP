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

    /**Custom Attributes */
    public function getFullUnitsAttribute () {
        return $this->concentration . ' (' . $this->unit->short_name .  ')';
    }

    public function getFullNameAttribute () {
        return $this->name . ' - ' . $this->concentration . ' (' . $this->unit->short_name .  ')';
    }

    public function getPresentationAttribute () {
        return $this->form->name;
    }

    /**Relations */
    public function form () {
        return $this->belongsTo('App\Models\MedicineForm', 'medicine_form_id');
    }

    public function unit () {
        return $this->belongsTo('App\Models\MedicineUnit', 'medicine_unit_id');
    }

    /**Scopes */
    public function scopeSearch ($query, $search) {
        return $query->where(
            'name', 'like', '%' . $search . '%'
        )->orderBy(
            'name', 'asc'
        );
    }
}
