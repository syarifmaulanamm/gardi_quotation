<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LandArrangement extends Model
{
    public $timestamps = true;
    protected $table = 'land_arrangement';

    public function cur()
    {
        return $this->hasOne('App\Currency', 'id', 'currency');
    }
}
