<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionTable extends Model
{
    //
    protected $fillable = ['sr', 'account_id', 'date', 'detail', 'dr', 'cr', 'voucher_type', 'check_no', 'clearance_date', 'bank_name', 'sale_invoice', 'purchase_invoice' ];
}

