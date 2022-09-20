<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventPerson extends Model
{
    //
    public $table ='user_event_person';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'short_desc', 'image'
    ];
}
