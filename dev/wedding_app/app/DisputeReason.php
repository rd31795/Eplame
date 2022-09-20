<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class DisputeReason extends Model
{
    
	use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'reasons', 'slug', 'status'
    ];

    public function sluggable() {
        return [

            'slug' => [
                'source' => 'reasons'
            ]
        ];
    }
}
