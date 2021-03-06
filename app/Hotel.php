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

    // Rooms
    public function rooms()
    {
        return $this->hasMany('App\HotelRoom', 'hotel_id', 'id');
    }
}
