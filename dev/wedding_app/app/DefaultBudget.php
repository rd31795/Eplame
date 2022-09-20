<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultBudget extends Model
{
    protected $fillable = [
    	'event_type_id', 
        'catagory_id',
        'percentage',
    ];

    public function eventTypeID() {
        return $this->belongsTo('App\Event', 'event_type_id');
    }

    public function Categories() {
        return $this->belongsTo('App\Categories', 'catagory_id');
    }
}
