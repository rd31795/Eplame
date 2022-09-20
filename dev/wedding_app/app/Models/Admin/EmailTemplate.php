<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'subject', 'title', 'body'
    ];

}
