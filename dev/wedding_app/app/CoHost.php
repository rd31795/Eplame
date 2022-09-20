<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoHost extends Model
{
    protected $fillable = [
        'host_id', 'cohost_id', 'cohost_name', 'cohost_email', 'event_id', 'status', 'relation', 'event_sharing', 'guest_management', 'checklist_management', 'budget_management', 'event_management', 'vendor_management'
    ];

    public function host() {
        return $this->belongsTo('App\User', 'host_id');
    }

	public function cohost() {
        return $this->belongsTo('App\User', 'cohost_id');
    }

	public function event() {
        return $this->belongsTo('App\UserEvent', 'event_id');
    }
}



