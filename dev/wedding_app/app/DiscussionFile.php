<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class DiscussionFile extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
    	'user_id', 
        'group_id',
        'title',
        'slug',
        'description',
        'type',
        'path'
    ];

    public function discussionFileUserId() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function discussionFileGroupId() {
        return $this->belongsTo('App\DiscussionGroup', 'group_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
