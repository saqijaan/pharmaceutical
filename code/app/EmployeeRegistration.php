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

    protected $guard = 'employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','email','password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function accounts(){
        return $this->hasOne( OneToOneAccounts::class ,'employe_id','id' );
    }
    public function answers(){
        return $this->hasMany( QuizAnswer::class , 'employe_id','id' );
    }

    public function dailySummaries(){
        return $this->hasMany( DailySummary::class );
    }

    public function reportsTo(){
        return $this->belongsTo( EmployeeRegistration::class , 'reports_to' );
    }
}
