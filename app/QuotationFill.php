<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationFill extends Model
{
    public $timestamps = true;
    protected $table = 'quotation_fill';
    protected $casts = [
        'fixed_cost_errors' => 'array',
        'variable_cost_errors' => 'array',
        'other_expenses_errors' => 'array',
        'land_arrangement_errors' => 'array',
        'summary_errors' => 'array',
    ];
}
