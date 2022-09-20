<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
     public function vendor()
    {
       return $this->belongsTo('App\User','vendor_id','id');
    }
}
