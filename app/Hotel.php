<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public $timestamps = true;
    protected $table = 'hotel';
    protected $casts = [
        'feature' => 'array',
        'images' => 'array',
    ];
}
