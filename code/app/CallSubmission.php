<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallSubmission extends Model
{
    public function employee(){
        return $this->belongsTo( EmployeeRegistration::class ,'employe_id' );
    }
    public function docter(){
        return $this->belongsTo( DoctorRegis::class ,'docter_id' );
    }
}
