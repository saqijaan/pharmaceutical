<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected $fillable = ['id', 'question', 'date','options', 'start_time', 'end_time'];

    protected $casts = [
        'options' => 'Object'
    ];

}