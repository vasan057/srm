<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentFeeHistory extends Model
{
    public function student(){
        return $this->belongsTo('App\Model\Student','student_id','id');
    }
    public function suggest(){
        return $this->belongsTO('App\Model\StudentSuggest','suggest_id','id');
    }
}
