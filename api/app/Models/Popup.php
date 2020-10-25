<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = [
        'page_id',
        'title',
        'timer',
        'scroll',
        'exit_intent',
        'trigger_every',
        'content',
    ];

    protected $casts = [
        'exit_intent' => 'boolean',
    ];
}
