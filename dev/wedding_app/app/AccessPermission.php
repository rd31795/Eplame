<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessPermission extends Model
{
     protected $fillable = [
        'user_id', 'menu_id','group_id','read_permission', 'write_permission'
    ];


   public function users() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function menus() {
        return $this->belongsTo('App\Menu', 'menu_id');
    }
    public function groups() {
        return $this->belongsTo('App\Group', 'group_id');
    }
    
}
