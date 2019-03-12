<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistributerSalesOrder extends Model
{
    public function items(){
        return $this->hasMany( DistributerSalesOrderItems::class , 'dis_sls_odr_id' );
    }
}
