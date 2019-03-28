<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailySummary extends Model
{
    public function employe(){
        return $this->belongsTo( EmployeeRegistration::class );
    }
}
