<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchedleModel extends Model
{
    //
    protected $fillable = ['id','employee_id', 'date', 'doctor', 'address', 'detail', 'gift', 'sample', 'brochure', 'city'];


    public function Doctor(){
        return $this->belongsTo( DoctorRegis::class, 'doctor','id' );
    }
}
