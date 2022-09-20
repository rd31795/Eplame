<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    protected $table="event_ticket";
    public $timestamp=true;


    public function event_template()
    {
        return $this->belongsTo(EventTemplate::class,'event_template_id','id');
    }

    public function user_events()
    {
    	return $this->belongsTo(UserEvent::class,'event_id','id');
    }
}
