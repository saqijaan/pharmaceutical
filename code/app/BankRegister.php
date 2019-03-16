<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankRegister extends Model
{
    public const ACCOUNT_HEAD     = 1;
    public const ACCOUNT_SUB_HEAD = 3;

    protected $fillable = [
        'name'
    ];
    public function account(){
        return $this->belongsTo( Accounts::class, 'account_id' );
    }
}
