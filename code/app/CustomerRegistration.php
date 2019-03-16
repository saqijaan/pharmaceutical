<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerRegistration extends Model
{
    public const ACCOUNT_HEAD     = 1;
    public const ACCOUNT_SUB_HEAD = 4;

    public function accounts(){
        return $this->hasOne( OneToOneAccounts::class ,'customer_id','id' );
    }
}
