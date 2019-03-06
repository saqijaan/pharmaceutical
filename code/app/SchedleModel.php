<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchedleModel extends Model
{
    //
    protected $fillable = ['id', 'date', 'doctor', 'address', 'detail', 'gift', 'sample', 'brochure', 'city'];

}
