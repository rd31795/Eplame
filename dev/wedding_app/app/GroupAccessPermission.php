<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupAccessPermission extends Model
{
 protected $fillable = [
        'user_id', 'group_id'
    ];
}
