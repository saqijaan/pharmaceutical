<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
class EmployeeRegistration extends Authenticatable
{
    use Notifiable;
    
    public function answers(){
        return $this->hasMany( QuizAnswer::class , 'employe_id','id' );
    }
}
