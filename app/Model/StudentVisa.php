<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentVisa extends Model
{
    protected $fillable = ["student_id"];
    public function setVisaExpiryDateAttribute($value){
        $this->attributes['visa_expiry_date'] = date('Y-m-d',strtotime($value));
    }
    public function setVisaGrandDateAttribute($value){
        $this->attributes['visa_grand_date'] = date('Y-m-d',strtotime($value));
    }
}
