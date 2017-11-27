<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InstitutionCourse extends Model
{
    public $timestamps = true;
    protected $fillable = ['created_at','updated_at'];

    public function institute(){
        return $this->belongsTo('App\Model\Institution','institute_id','id');
    }

    public function suggest(){
        return $this->hasOne('App\Model\StudentSuggest','course_id','id');
    }
}
