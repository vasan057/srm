<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentReferral extends Model
{
    protected $fillable = ["student_id"];

    public function refStudent(){
        return $this->belongsTo('App\Model\Student','ref_student_id','id');
    }
    public function student(){
        return $this->belongsTo('App\Model\Student','student_id','id');
    }

    public function others(){
        return $this->belongsTo('App\Model\StudentOtherReferral','ref_other_id','id');
    }

    public function commision(){
    	return $this->hasOne('App\Model\StudentReferralCommision','reference_id','id');
    }
}
