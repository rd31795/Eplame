<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
    	'user_id', 
        'discussion_id',
        'ip_address'
    ];

    public function viewsUserId() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function viewsDiscussionId() {
        return $this->belongsTo('App\Discussion', 'discussion_id');
    }
}
