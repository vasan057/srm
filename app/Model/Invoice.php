<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['student_id','institute_id','suggest_id'];
   
    public function institute(){
        return $this->belongsTO('App\Model\Institution','institute_id','id');
    }
    public function suggest(){
        return $this->belongsTo('App\Model\StudentSuggest','suggest_id','id');
    }

    public function selfInstitute(){
        return $this->hasMany('App\Model\Invoice','institute_id','institute_id');
    }

    public function student(){
        return $this->belongsTO('App\Model\Student','student_id','id');
    }
}
