<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRegistration extends Model
{
    public function answers(){
        return $this->hasMany( QuizAnswer::class , 'employe_id','id' );
    }
}
