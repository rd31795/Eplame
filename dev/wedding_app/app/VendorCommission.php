<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorCommission extends Model
{
  protected $fillable = [
        'vendor_id','slab_from','slab_to','commission_type', 'amount', 'min_amount','type','status'
    ];
}
