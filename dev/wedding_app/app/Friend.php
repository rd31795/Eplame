<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'request_status'
    ];

    public function senderId() {
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function recieverId() {
        return $this->belongsTo('App\User', 'reciever_id');
    }
}
