<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventMetaData extends Model
{
        protected $fillable = ['parent', 'user_id', 'event_id', 'type', 'key', 'key_value'];

    public function eventCategory() {
        return $this->hasOne('App\Category', 'id', 'key_value');
    }


    public function getHiredVendor($value='')
    {
    	  return $this->hasOne('App\Models\EventOrder', 'category_id', 'key_value')->where('event_id',$this->event_id)->where('type','order');
 
    }
}
