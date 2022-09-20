<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleType extends Model
{
    protected $fillable = [
        'role'
    ];
}


public function userRoles()
    {
       return $this->hasMany('App\UserRoles');
    }
