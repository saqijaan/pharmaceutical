<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OneToOneAccounts extends Model
{
    public function account(){
        return $this->belongsTo( Accounts::class ,'account_id' );
    }

    public function customer(){
        return $this->belongsTo( CustomerRegistration::class ,'customer_id' );
    }

    public function supplier(){
        return $this->belongsTo( SupplyRegistration::class ,'supplier_id' );
    }

    public function employee(){
        return $this->belongsTo( EmployeeRegistration::class ,'employe_id' );
    }

    public function distributer(){
        return $this->belongsTo( DistributerRegistration::class ,'distributer_id' );
    }
}
