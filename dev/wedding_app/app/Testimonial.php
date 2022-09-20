<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
    	'title', 
        'image',
        'summary',
        'status',
        'type'
    ];

    CONST E_SHOP=2;
    CONST EVENTS=1;
}
