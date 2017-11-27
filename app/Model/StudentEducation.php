<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentEducation extends Model
{
    public $timestamps = true;
    protected $fillable = ['created_at','updated_at','course_from','course_to'];
    public function setCourseFromAttribute($value){
        $this->attributes['course_from'] = date('Y-d-m',strtotime($value));
    }
    public function setCourseToAttribute($value){
        $this->attributes['course_to'] = date('Y-d-m',strtotime($value));
    }
}
