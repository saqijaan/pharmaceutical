<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    //
    protected $fillable = ['employe_id','quiz_id','answer','date','x','y'];
    public function saveData($data){

        $params = array();

        if( $data['date'] ){
            $params['date'] = date( 'Y,m,d', strtotime($data['date']));
        }

        if( $data['employe_id'] ){
            $params['employe_id'] = $data['employe_id'];
        }

        if( $data['quiz_id'] ){
            $params['quiz_id'] = $data['quiz_id'];
        }

        if( $data['answer'] ){
            $params['answer'] = $data['answer'];
        }

        if( $data['x'] ){
            $params['x'] = $data['x'];
        }

        if( $data['y'] ){
            $params['y'] = $data['y'];
        }


        return $params;
    }

    public function quiz(){
        return $this->belongsTo( Quiz::class ,'quiz_id', 'id' );
    }
}
