<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalRequestForm extends Model
{
    protected $casts = [
        'data' => 'Object'
    ];

    protected $fillable = [
        'employee_id',
        'data',
    ];

    public function employee(){
        return $this->belongsTo( EmployeeRegistration::class, 'employee_id' );
    }
}
