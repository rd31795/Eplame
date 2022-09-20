<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NegotiationDiscount extends Model
{
	CONST IN_ACTIVE=0;
    CONST ACTIVE=1;
    CONST PERCENT=0;
    CONST AMOUNT=1;
    CONST IS_USED=1;
    CONST NOT_USED=0;
    CONST NegotiationNotExist=0;
    public function products()
    {
         return $this->belongsTo('App\Models\Products\Product','product_id','id');
    }

}
