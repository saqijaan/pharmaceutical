<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalActivityForm extends Model
{
    protected $casts = [
        'data' => 'Object'
    ];

    protected $fillable = [
        'employee_id',
        'data',
        'level_id',
    ];

    public function filledBy(){
        return $this->belongsTo( EmployeeRegistration::class, 'employee_id' );
    }

    public function currentLevel(){
        return $this->belongsTo( EmployeeRegistration::class, 'level_id' );
    }
}
