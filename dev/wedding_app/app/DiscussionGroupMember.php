<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionGroupMember extends Model
{
    protected $fillable = [
    	'user_id', 
        'group_id'
    ];

    public function memberUserId() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function memberGroupId() {
        return $this->belongsTo('App\DiscussionGroup', 'group_id');
    }
}
