<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessReview extends Model
{
    protected $fillable = [
    	'user_id',
    	'order_id',
    	'event_id',
    	'vendor_category_id',
    	'rating',
    	'title',
    	'summary',
        'images',
    	'admin_approval'
    ];

    public function businessreviewUserId() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function businessrevieweventId() {
        return $this->belongsTo('App\UserEvent', 'event_id');
    }

    public function businessrevieworderId() {
        return $this->belongsTo('App\Models\EventOrder', 'order_id');
    }

    public function businessreviewbusinessId() {
        return $this->belongsTo('App\VendorCategory', 'vendor_category_id');
    }
}
