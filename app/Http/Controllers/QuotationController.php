<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Quotation;
use App\QuotationCategory;
use App\QuotationItems;
use App\Currency;
use App\FixedCost;
use App\VariableCost;

class QuotationController extends Controller
{
    public function list(Request $request)
    {
        $data['title'] = 'Quotations'; 
        if($request->session()->get('login_data')['level'] == 5){
            $data['quotations'] = Quotation::where('user_id', $request->session()->get('login_data')['id'])->paginate(9);            
        }else if($request->session()->get('login_data')['level'] == 1){
            $data['quotations'] = Quotation::paginate(9);            
        }

        return view('quotation/list', $data);
    }

    // Create
    public function create(Request $request)
    {
        $data['title'] = 'Create Quotation';
        $data['category'] = QuotationCategory::orderBy('name', 'asc')->get(); 
        $data['currency'] = Currency::orderBy('code', 'asc')->get(); 
        return view('quotation/create', $data);
    }

    public function doCreate(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'tour_name' => 'required',
            'category_id' => 'required',
            'number_of_pax' => 'required',
            'currency_id' => 'required',
            'validity' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('quotation/create')
                        ->withErrors($validator)
                        ->withInput();
        } 

        $quot = new Quotation;
        $quot->tour_name = $request->tour_name;
        $quot->category_id = $request->category_id;
        $quot->number_of_pax = $request->number_of_pax;
        $quot->currency_id = $request->currency_id;
        $quot->validity = date('Ymd', strtotime($request->validity));
        $quot->user_id = $request->session()->get('login_data')['id'];
        $quot->save();

        $request->session()->flash('msg', 'Quotation berhasil disimpan!');
        return redirect('quotation/basket/'.$quot->id);
    }
    
    public function basket(Request $request, $id)
    {
        if(!$id){
            return redirect('quotation');
        }

        $data['quot'] = Quotation::find($id);
        $data['category'] = QuotationCategory::orderBy('name', 'asc')->get(); 
        $data['currency'] = Currency::orderBy('code', 'asc')->get(); 
        $data['title'] = ucwords($data['quot']->tour_name); 
        return view('quotation/basket', $data);
    }   

    // Fixed Cost
    public function fixedCost(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation');
        }

        $data['quotation'] = Quotation::find($id);
        $data['fixedCost'] = FixedCost::where('quotation_id', $id);
        $data['title'] = 'Fixed Cost'; 
        return view('quotation/fixedCost/index', $data);
    }
    // Create
    public function createFixedCost(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation/'.$id.'/fixedcost');
        }

        $data['quotation'] = Quotation::find($id);
        $data['items'] = QuotationItems::orderBy('name', 'asc')->get();
        $data['currency'] = Currency::orderBy('code', 'asc')->get(); 
        $data['title'] = 'Add Fixed Cost'; 
        return view('quotation/fixedCost/create', $data);
    }
}
