<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    public $timestamps = true;
    protected $table = 'quotation';
    
    public function cat()
    {
        return $this->hasOne('App\QuotationCategory', 'id', 'category_id');
    }

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function cur()
    {
        return $this->hasOne('App\Currency', 'id', 'currency_id');
    }

    public function fixed_cost()
    {
        return $this->hasMany('App\FixedCost', 'quotation_id', 'id');
    }

    public function sum_fixed_cost()
    {
        return $this->fixed_cost->sum('amount');
    }
}
