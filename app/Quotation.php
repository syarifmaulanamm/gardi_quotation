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

    // Fixed Cost
    public function fixed_cost()
    {
        return $this->hasMany('App\FixedCost', 'quotation_id', 'id');
    }

    public function sum_fixed_cost()
    {
        return $this->fixed_cost->sum('amount');
    }

    // Variable Cost
    public function variable_cost()
    {
        return $this->hasMany('App\VariableCost', 'quotation_id', 'id');
    }

    public function sum_variable_cost()
    {
        return $this->variable_cost->sum('amount');
    }

    // Other Expenses
    public function other_expenses()
    {
        return $this->hasMany('App\OtherExpenses', 'quotation_id', 'id');
    }

    public function sum_other_expenses()
    {
        return $this->other_expenses->sum('amount');
    }

    // Land Arrangement
    public function land_arrangement()
    {
        return $this->hasMany('App\LandArrangement', 'quotation_id', 'id');
    }

    public function sum_land_arrangement()
    {
        return $this->land_arrangement->sum('amount');
    }
}
