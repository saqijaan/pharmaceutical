<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailySummary extends Model
{
    protected $fillable = [
        'employee_id',
        'work_type',
        'dailyfixedAmount',
        'total_km',
        'night_stay',
        'night_stay_allownce',
        'night_stay_description',
        'image',
        'travelHitory'
    ];
    public function employe(){
        return $this->belongsTo( EmployeeRegistration::class );
    }
}
