<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
class EmployeeRegistration extends Authenticatable
{
    use Notifiable;
    public const ACCOUNT_HEAD     = 2;
    public const ACCOUNT_SUB_HEAD = 9;

    public function accounts(){
        return $this->hasOne( OneToOneAccounts::class ,'employe_id','id' );
    }
    public function answers(){
        return $this->hasMany( QuizAnswer::class , 'employe_id','id' );
    }
}
