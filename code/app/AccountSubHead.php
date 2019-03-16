<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSubHead extends Model
{
    public function head(){
        return $this->belongsTo( AccountHead::class,'head_id');
    }
}
