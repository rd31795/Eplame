<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class DiscussionGroup extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [ 
        'label',
        'slug',
        'status',
        'thumbnail',
        'cover_img',
    ];

    public function sluggable()
    {
        return [

            'slug' => [
                'source' => 'label'
            ]
        ];
    }

    public function groupdiscussions(){
        return $this->hasMany('App\Discussion', 'group_id');
    }

    public function groupphotos(){
        return $this->hasMany('App\DiscussionFile', 'group_id')->where('type', 'photo');
    }

    public function groupvideos(){
        return $this->hasMany('App\DiscussionFile', 'group_id')->where('type', 'video');
    }

    public function groupmembers(){
        return $this->hasMany('App\DiscussionGroupMember', 'group_id');
    }
}
