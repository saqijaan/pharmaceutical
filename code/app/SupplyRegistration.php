<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplyRegistration extends Model
{
    public const ACCOUNT_HEAD     = 2;
    public const ACCOUNT_SUB_HEAD = 8;

    public function accounts(){
        return $this->hasOne( OneToOneAccounts::class ,'supplier_id','id' );
    }
}
