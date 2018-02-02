<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function list(Request $request)
    {
        $data['title'] = 'Quotations'; 
        return view('quotation/list', $data);
    }

    public function create(Request $request)
    {
        $data['title'] = 'Create Quotation'; 
        return view('quotation/create', $data);
    }
    
    public function basket(Request $request)
    {
        $data['title'] = 'Name Of Tour'; 
        return view('quotation/basket', $data);
    }   
}
