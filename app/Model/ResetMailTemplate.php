<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ResetMailTemplate extends Model
{
    protected $fillable = ['id'];
    public function photo(){
        return $this->belongsTo('App\Model\Gallery','photo_id','id');
    }
}
