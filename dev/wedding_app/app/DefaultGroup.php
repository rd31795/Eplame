<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class DefaultGroup extends Model
{

	use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
    	'event_type_id', 
        'group_label',
        'slug',
        'status'
    ];

    public function eventTypeId() {
        return $this->belongsTo('App\Event', 'event_type_id');
    }

    public function sluggable()
    {
        return [

            'slug' => [
                'source' => 'group_label'
            ]
        ];
    }
}
