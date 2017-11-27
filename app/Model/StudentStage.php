<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentStage extends Model
{
    protected $fillable = ["student_id"];
    
    public function student(){
    	return $this->belongsTO('App\Model\Student','student_id','id');
    }
}
