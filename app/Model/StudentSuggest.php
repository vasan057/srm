<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentSuggest extends Model
{
    protected $fillable = ["course_id","id",'student_id'];
}
