<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributerRegistration extends Model
{
    public const ACCOUNT_HEAD     = 1;
    public const ACCOUNT_SUB_HEAD = 5;

    public function accounts(){
        return $this->hasOne( OneToOneAccounts::class ,'distributer_id','id' );
    }
}
