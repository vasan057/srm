<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    public function history(){
        return $this->hasMany('App\Model\StudentFeeHistory','fee_id','id');
    }

    public function suggest(){
        return $this->belongsTo('App\Model\StudentSuggest','suggest_id','id');
    }
}
