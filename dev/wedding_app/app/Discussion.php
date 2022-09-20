<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Discussion extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
    	'user_id', 
        'group_id',
        'title',
        'slug',
        'description'
    ];

    public function discussionUserId() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function discussionGroupId() {
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
