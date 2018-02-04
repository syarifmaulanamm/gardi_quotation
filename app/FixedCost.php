<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedCost extends Model
{
    public $timestamps = true;
    protected $table = 'fixed_cost';

    public function cur()
    {
        return $this->hasOne('App\Currency', 'id', 'currency');
    }
}
