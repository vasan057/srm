<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Faculty extends Authenticatable
{
    use Notifiable;
    
    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
     public function routeNotificationForMail()
     {
         return $this->email_id;
     }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     protected $hidden = [
        'password', 'remember_token',
    ];

    public function photo(){
        return $this->belongsTo('App\Model\Gallery','photo_id','id');
    }

    public function type(){
        return $this->belongsTo('App\Model\FacultyType','faculty_type','id');
    } 

    public function access(){
        return $this->hasOne('App\Model\FacultyAccess','faculty_id','id');
    }
}
