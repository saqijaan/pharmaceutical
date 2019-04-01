<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallSubmission extends Model
{
    protected $fillable = [
        'employe_id','docter_id','day','x','y','detail','product','gift','sample','visited'
    ];
    public function employee(){
        return $this->belongsTo( EmployeeRegistration::class ,'employe_id' );
    }
    public function docter(){
        return $this->belongsTo( DoctorRegis::class ,'docter_id' );
    }
}
