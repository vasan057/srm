<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentHealthCover extends Model
{

    protected $fillable = ['expiry_date','student_id'];
    
    public function setExpiryDateAttribute($value){
        $this->attributes['expiry_date'] = date('Y-m-d',strtotime($value));
    }
}
