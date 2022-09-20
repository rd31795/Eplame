<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDispute extends Model
{
    public function users()
    {
    	return $this->hasMany('App\User','user_id');
    }
}
