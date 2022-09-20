<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Auth;

class VendorVacation extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

     protected $fillable = [
        'vendor_id', 'slug', 'vacation_from','vacation_to','status'
    ];
    public function sluggable()
    {
        return [

            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
