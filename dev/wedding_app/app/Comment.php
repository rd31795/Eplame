<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'user_id', 
        'discussion_id',
        'parent_comment_id',
        'description'
    ];

    public function commentUserId() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function commentDiscussionId() {
        return $this->belongsTo('App\Discussion', 'discussion_id');
    }
}
