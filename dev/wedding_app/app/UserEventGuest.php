<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventGuest extends Model
{
    protected $fillable = [
	  	'user_id', 
      	'user_event_id',
      	'user_event_group_id',
      	'user_event_menu_id',
      	'fname',
      	'lname',
      	'age',
      	'email',
      	'attendance',
      	'contact_no',
      	'gender'

    ];

    public function guestUser() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function guestEvent()
    {
       return $this->belongsTo('App\UserEvent', 'user_event_id');
    }

    public function guestGroup()
    {
       return $this->belongsTo('App\UserEventGroup', 'user_event_group_id');
    }

    public function guestMenu()
    {
       return $this->belongsTo('App\UserEventMenu', 'user_event_menu_id');
    }
    
}
