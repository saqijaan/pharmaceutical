<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    public function subHeads(){
        return $this->hasMany( AccountSubHead::class ,'head_id' );
    }
}
