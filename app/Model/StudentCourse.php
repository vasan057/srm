<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{

    public function setCommencementYearAtrribute($value){
        $this->attributes['commencement_year'] = $value.'-01-01';
    }
}
