<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributerOrderBook extends Model
{
    protected $fillable= [
        'delivered'
    ];
    public function items(){
        return $this->hasMany( DistributerOrderBookItem::class,'dis_odr_book_id' );
    }
}
