<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherExpenses extends Model
{
    public $timestamps = true;
    protected $table = 'other_expenses';

    public function cur()
    {
        return $this->hasOne('App\Currency', 'id', 'currency');
    }
}
