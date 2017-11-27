<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentFollowup extends Model
{
    
    public function setRemindTimeAttribute($value){
    	$this->attributes['remind_time'] = date('Y-m-d',strtotime($value));
    }

    public function student(){
    	return $this->belongsTo('App\Model\Student','student_id','id');
    }
}
