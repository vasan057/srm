<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InstituteFollowup extends Model
{
    
    public function institution(){
    	return $this->belongsTO('App\Model\Institution','institute_id','id');
    }
}
