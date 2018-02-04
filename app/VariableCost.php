<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VariableCost extends Model
{
    public $timestamps = true;
    protected $table = 'variable_cost';

    public function cur()
    {
        return $this->hasOne('App\Currency', 'id', 'currency');
    }
}
