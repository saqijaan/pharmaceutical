<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'employee_id',
        'city_id',
        'docters',
        'day',
        'detail',
    ];

    protected $casts = [
        'docters' => 'Array'
    ];
    public function employee(){
        return $this->belongsTo( EmployeeRegistration::class, 'employee_id' );
    }

    public function city(){
        return $this->belongsTo(CityRegistration::class, 'city_id');
    }

    public function docters(){
        $collection = new Collection();
        foreach ($this->docters as $id) {
           $collection->push(
               DoctorRegis::find($id)
           );
        }
        return $collection;
    }
}
