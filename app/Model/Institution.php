<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    public function setIntakeMonthAttribute($value){
        if(!empty($value)){
            $this->attributes['intake_month'] = implode(', ',$value);
        }
    }

    public function photo(){
        return $this->belongsTo('App\Model\Gallery','photo_id','id');
    }
    
    public function ielts(){
        return $this->hasOne('App\Model\InstitutionIelts','institute_id','id');
    }
    public function pte(){
        return $this->hasOne('App\Model\InstitutionPte','institute_id','id');
    }
    public function course(){
        return $this->hasMany('App\Model\InstitutionCourse','institute_id','id');
    }

    public function delete()
    {
        $this->course()->delete();
        $this->ielts()->delete();
        $this->pte()->delete();
        return parent::delete();
    }
}
