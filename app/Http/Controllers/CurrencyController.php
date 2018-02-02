<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Currency;
use App\ExchangeRate;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Currency';
        $data['currency'] = Currency::when($request->keyword, function ($query) use ($request) {
            $query->where('code', 'like', "%{$request->keyword}%")
                ->orWhere('name', 'like', "%{$request->keyword}%");
        })->paginate(10);

        $data['currency']->appends($request->only('keyword'));

        return view('currency/index', $data);
    }

    // Create
    public function create(Request $request)
    {
        $data['title'] = 'Create Currency';
        
        return view('currency/create', $data);
    }

    public function doCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|max:3',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('currency/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Save to DB
        $currency = new Currency;
        $currency->code = $request->code;
        $currency->name = $request->name;
        $currency->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('currency');
    }

    // Update
    public function update(Request $request, $id)
    {
        $data['title'] = 'Update Currency';
        $data['currency'] = Currency::find($id);

        if($data['currency']){
            return view('currency/update', $data);
        }
    }

    public function doUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id'   => 'required',
            'code' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('currency/update')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Save to DB
        $currency = Currency::find($request->id);
        $currency->code = $request->code;
        $currency->name = $request->name;
        $currency->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('currency');
    }

    // Delete
    public function delete(Request $request, $id)
    {
        if($id){
            $currency = Currency::find($id);
            $currency->delete();

            return response()->json(array('success' => true));
        }
    }

    /**
     * Exchange Rate
     */
    // Index
    public function exchangeRate(Request $request)
    {
        $data['title'] = 'Exchange Rate';
        $data['exchangeRate'] = ExchangeRate::when($request->keyword, function ($query) use ($request) {
            $query->where('from', 'like', "%{$request->keyword}%")
                ->orWhere('to', 'like', "%{$request->keyword}%");
        })->paginate(10);

        $data['exchangeRate']->appends($request->only('keyword'));

        return view('exchangeRate/index', $data);
    }
    // Create
    public function createExchangeRate(Request $request)
    {
        $data['title'] = 'Add Exchange Rate';
        $data['currency'] = Currency::all();

        return view('exchangeRate/create', $data);        
    }

    public function doCreateExchangeRate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required',
            'to'   => 'required',
            'rate' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('exchange-rate/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Save to DB
        $er = new ExchangeRate;
        $er->from = $request->from;
        $er->to   = $request->to;
        $er->rate = str_replace(',', '', $request->rate);
        $er->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('exchange-rate');
    }

    // Update Exchange Rate
    public function updateExchangeRate(Request $request, $id)
    {
        if($id){
            $data['title'] = 'Update Exchange Rate';
            $data['exchangeRate'] = ExchangeRate::find($id);

            $data['currency'] = Currency::all();    

            return view('exchangeRate/update', $data);
        }        
    }

    public function doUpdateExchangeRate(Request $request, $id)
    {
        if($id){
            $validator = Validator::make($request->all(), [
                'from' => 'required',
                'to'   => 'required',
                'rate' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('exchange-rate/update/$id')
                            ->withErrors($validator)
                            ->withInput();
            }

            // Save to DB
            $er = ExchangeRate::find($id);
            $er->from = $request->from;
            $er->to   = $request->to;
            $er->rate = str_replace(',', '', $request->rate);
            $er->save();

            $request->session()->flash('msg', 'Data berhasil disimpan!');
            return redirect('exchange-rate');
        }
    }

    // Delete
    public function deleteExchangeRate(Request $request, $id)
    {
        if($id){
            $er = ExchangeRate::find($id);
            $er->delete();

            return response()->json(array('success' => true));
        }
    }
}
