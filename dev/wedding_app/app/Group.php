<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Group extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'title', 'slug', 'status'
    ];

    public function sluggable() {
        return [

            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function accesspermissions()
    {
       return $this->hasMany('App\AccessPermission');
                   
    }
}
