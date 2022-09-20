<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsOffer extends Model
{
    protected $fillable = [ 
        'detail',
        'status',
        'type'
    ];
}
