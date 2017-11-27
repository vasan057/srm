<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function setDobAttribute($value){
        $this->attributes['dob'] = date('Y-m-d',strtotime($value));
    }

    public function assignTo(){
        return $this->belongsTo('App\Model\Faculty','staff_assigned_to','id');
    }

    public function courses(){
        return $this->hasMany('App\Model\StudentCourse','student_id','id');
    }
    
    public function docs(){
        return $this->hasOne('App\Model\StudentDocument','student_id','id');
    }

    public function education(){
        return $this->hasMany('App\Model\StudentEducation','student_id','id');
    }

    public function health(){
        return $this->hasOne('App\Model\StudentHealthCover','student_id','id');
    }

    public function ielts(){    
        return $this->hasOne('App\Model\StudentIelts','student_id','id');
    }

    public function pte(){    
        return $this->hasOne('App\Model\StudentPte','student_id','id');
    }

    public function referal(){    
        return $this->hasOne('App\Model\StudentReferral','student_id','id');
    }

    public function visa(){
        return $this->hasOne('App\Model\StudentVisa','student_id','id');
    }
    public function funding(){
        return $this->hasOne('App\Model\StudentFunding','student_id','id');
    }
    public function work(){
        return $this->hasMany('App\Model\StudentWork','student_id','id');
    }
    public function photo(){
        return $this->belongsTo('App\Model\Gallery','photo_id','id');
    }
    public function suggest(){
        return $this->hasMany('App\Model\StudentSuggest','student_id','id');
    }
    public function fees(){
        return $this->hasOne('App\Model\StudentFee','student_id','id');
    }
    public function followup(){
        return $this->hasMany('App\Model\StudentFollowup','student_id','id');
    }

    public function stage(){
        return $this->hasOne('App\Model\StudentStage','student_id','id');
    }
    public function stage_comment(){
        return $this->hasMany('App\Model\StudentStageComment','student_id','id')->where('is_active',1);   
    }
    public function delete()
    {
        $this->courses()->delete();
        $this->docs()->delete();
        $this->education()->delete();
        $this->health()->delete();
        $this->ielts()->delete();
        $this->pte()->delete();
        $this->referal()->delete();
        $this->visa()->delete();
        $this->funding()->delete();
        $this->work()->delete();
        $this->suggest()->delete();
        $this->followup()->delete();
        $this->stage()->delete();
        $this->stage_comment()->delete();
        return parent::delete();
    }
}
