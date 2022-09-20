<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Auth;
class Coupon extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'deal_code','deal_life','deal_off_type','title', 'slug', 'amount','	description','expiry_date','start_date','min_price','status'
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
