<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventGroup extends Model
{
    protected $fillable = [
    	    'user_id', 
          'user_event_id',
          'group_label'
    ];

    public function groupUser() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function groupUserEvent() {
        return $this->belongsTo('App\UserEvent', 'user_event_id');
    }
    public function eventRegistration()
    {
        return $this->hasMany('App\EventRegistration');
    }
}
