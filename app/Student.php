<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function followup(){
    	return $this->hasMany('App\Model\StudentFollowup','student_id','id');
    }
}
