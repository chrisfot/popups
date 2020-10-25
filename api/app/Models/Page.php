<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
    ];

    public function popups()
    {
        return $this->hasMany(Popup::class);
    }
}