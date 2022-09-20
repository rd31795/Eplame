<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventBudget extends Model
{
    protected $fillable = [
	    'user_id', 
      'user_event_id',
      'parent_catagory_id',
      'catagory_id',
      'catagory_label', 
      'estimated_budget',
      'final_budget',
      'paid_money',
      'note',
    ];

    public function budgetUser() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function subcategory()
    {
       return $this->hasMany($this,'catagory_id');
    }
}
