<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $guarded  = [];

    public const CASH_ACCOUNT   = 1;
    public const STOCK_ACCOUNT  = 2;
    public const CGS_ACCOUNT    = 3;
    public const SALES_ACCOUNT  = 4;

    public function transactions(){
        return $this->hasMany( TransactionTable::class, 'account_id' );
    }
}
