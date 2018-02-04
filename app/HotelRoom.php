<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    public $timestamps = true;
    protected $table = 'hotel_room';
    protected $casts = [
        'images' => 'array',
    ];

    public function roomType()
    {
        return $this->hasOne('App\RoomType', 'id', 'room_type');
    }

    public function bedType()
    {
        return $this->hasOne('App\BedType', 'id', 'bed_type');
    }

    public function cur()
    {
        return $this->hasOne('App\Currency', 'id', 'currency');
    }
}
