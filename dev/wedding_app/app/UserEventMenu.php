<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventMenu extends Model
{
    protected $fillable = [
    	    'user_id', 
          'user_event_id',
          'menu_label',
          'menu_description'
    ];

    public function menuUser() {
        return $this->belongsTo('App\User', 'user_id');
    }


    public function menuUserEvent()
    {
       return $this->belongsTo('App\UserEvent', 'user_event_id');
    }
}
