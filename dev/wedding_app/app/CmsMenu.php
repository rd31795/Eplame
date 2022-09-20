<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Auth;

class CmsMenu extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'page_type','cms_id','custom_name','custom_url', 'slug','status'
    ];


    public function sluggable()
    {
        return [

            'slug' => [
                'source' => 'custom_name'
            ]
        ];
    }
    
    public function cmspages() {
        return $this->belongsTo('App\Models\Admin\CmsPage', 'cms_id');
    }
}
