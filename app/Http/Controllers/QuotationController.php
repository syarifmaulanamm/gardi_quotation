<?php

namespace App\Http\Controllers;

use Validator;
use Excel;
use Illuminate\Http\Request;
use App\Quotation;
use App\QuotationFill;
use App\QuotationCategory;
use App\QuotationItems;
use App\Currency;
use App\ExchangeRate;
use App\FixedCost;
use App\VariableCost;
use App\OtherExpenses;
use App\LandArrangement;
use App\Hotel;

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

        $qFill = new QuotationFill;
        $qFill->quotation_id = $quot->id;
        $qFill->save();

        $request->session()->flash('msg', 'Quotation berhasil disimpan!');
        return redirect('quotation/basket/'.$quot->id);
    }

    public function doUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tour_name' => 'required',
            'category_id' => 'required',
            'number_of_pax' => 'required',
            'currency_id' => 'required',
            'validity' => 'required',
            'incentive_staff' => 'required',
            'commission_sales' => 'required',
            'profit' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('quotation/basket/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $quot = Quotation::find($id);
        $quot->tour_name = $request->tour_name;
        $quot->category_id = $request->category_id;
        $quot->number_of_pax = $request->number_of_pax;
        $quot->currency_id = $request->currency_id;
        $quot->incentive_staff = str_replace(',', '', $request->incentive_staff);
        $quot->commission_sales = str_replace(',', '', $request->commission_sales);
        $quot->cn = str_replace(',', '', $request->cn);
        $quot->profit = str_replace(',', '', $request->profit);
        $quot->net_per_pax = str_replace(',', '', $request->net_per_pax);
        $quot->ppn1 = str_replace(',', '', $request->ppn1);
        $quot->selling_price = str_replace(',', '', $request->selling_price);
        $quot->save();

        $qFill = new QuotationFill;
        $qFill->quotation_id = $quot->id;
        $qFill->save();

        $request->session()->flash('msg', 'Quotation berhasil disimpan!');
        return redirect('quotation');
    }

    public function basket(Request $request, $id)
    {
        if(!$id){
            return redirect('quotation');
        }

        $data['quot'] = Quotation::find($id);
        $data['category'] = QuotationCategory::orderBy('name', 'asc')->get();
        $data['currency'] = Currency::orderBy('code', 'asc')->get();
        $data['title'] = 'Create Quotation';
        $data['url_back'] = url('quotation');
        $data['qFill'] = QuotationFill::where('quotation_id', $id)->first();

        $exc_usd = ExchangeRate::where('from', 'USD')->where('to', 'IDR')->first();

        $data['ar_incentive'] = array(
            array(
              'nominal' => 0,
              'nominal_usd' => '',
              'description' => ''
            ),
            array(
              'nominal' => 10000,
              'nominal_usd' => round(10000 / $exc_usd->rate, 2),
              'description' => '(Domestic)'
            ),
            array(
              'nominal' => 15000,
              'nominal_usd' => round(15000 / $exc_usd->rate, 2),
              'description' => '(Asean)'
            ),
            array(
              'nominal' => 50000,
              'nominal_usd' => round(50000 / $exc_usd->rate, 2),
              'description' => '(Asia, Middle East & Umrah Promo)'
            ),
            array(
              'nominal' => 60000,
              'nominal_usd' => round(60000 / $exc_usd->rate, 2),
              'description' => '(Aussie & New Zealand)'
            ),
            array(
              'nominal' => 80000,
              'nominal_usd' => round(80000 / $exc_usd->rate, 2),
              'description' => '(Europe & Africa)'
            ),
            array(
              'nominal' => 100000,
              'nominal_usd' => round(100000 / $exc_usd->rate, 2),
              'description' => '(USA, Canada, Leisure Series, Umrah Reguler & Plus)'
            )
        );
        $data['ar_commission'] = array(
            array(
              'nominal' => 0,
              'nominal_usd' => '',
              'description' => ''
            ),
            array(
              'nominal' => 30000,
              'nominal_usd' => round(30000 / $exc_usd->rate, 2),
              'description' => '(Domestic)'
            ),
            array(
              'nominal' => 50000,
              'nominal_usd' => round(50000 / $exc_usd->rate, 2),
              'description' => '(Asean)'
            ),
            array(
              'nominal' => 100000,
              'nominal_usd' => round(100000 / $exc_usd->rate, 2),
              'description' => '(Asia, Middle East, Aussie & New Zealand)'
            ),
            array(
              'nominal' => 200000,
              'nominal_usd' => round(200000 / $exc_usd->rate, 2),
              'description' => '(USA, Canada, Europe & Africa)'
            ),
            array(
              'nominal' => 500000,
              'nominal_usd' => round(500000 / $exc_usd->rate, 2),
              'description' => '(Leisure Series & Umrah Promo)'
            ),
            array(
              'nominal' => 1000000,
              'nominal_usd' => round(1000000 / $exc_usd->rate, 2),
              'description' => '(Umrah Reguler & Plus)'
            )
        );

        $data['ar_profit'] = array(
            '0' => '',
            '15' => '15%',
            '16' => '16%',
            '17' => '17%',
            '18' => '18%',
            '19' => '19%',
            '20' => '20%',
            '21' => '21%',
            '22' => '22%',
            '23' => '23%',
            '24' => '24%',
            '25' => '25%',
            '26' => '26%',
            '27' => '27%',
            '28' => '28%',
            '29' => '29%',
        );

        // Fixed Cost
        $FCcreated = FixedCost::where('quotation_id', $id)->pluck('item')->toArray();
        $FCrequired = QuotationItems::where('block', 1)->where('required',1)->pluck('name')->toArray();

        if(!in_array($FCrequired[0], $FCcreated)){
            $dFC = array();

            for($i = 0; $i < count($FCrequired); $i++){
                $dFC[] = array(
                    'quotation_id' => $id,
                    'item' => $FCrequired[$i],
                    'currency' => $data['quot']->currency_id,
                    'price' => 0,
                    'quantity' => 0,
                    'duration' => 0,
                    'amount' => 0,
                    'remarks' => ''
                );
            }

            FixedCost::insert($dFC);
        }

        // Variable Cost
        $VCcreated = VariableCost::where('quotation_id', $id)->pluck('item')->toArray();
        $VCrequired = QuotationItems::where('block', 2)->where('required',1)->pluck('name')->toArray();

        if(!in_array($VCrequired[0], $VCcreated)){
            $dVC = array();

            for($i = 0; $i < count($VCrequired); $i++){
                $dVC[] = array(
                    'quotation_id' => $id,
                    'item' => $VCrequired[$i],
                    'currency' => $data['quot']->currency_id,
                    'price' => 0,
                    'quantity' => 0,
                    'duration' => 0,
                    'amount' => 0,
                    'remarks' => ''
                );
            }

            VariableCost::insert($dVC);
        }

        // Other Expenses
        $OEcreated = OtherExpenses::where('quotation_id', $id)->pluck('item')->toArray();
        $OErequired = QuotationItems::where('block', 3)->where('required',1)->pluck('name')->toArray();

        if(!in_array($OErequired[0], $OEcreated)){
            $dOE = array();

            for($i = 0; $i < count($OErequired); $i++){
                $dOE[] = array(
                    'quotation_id' => $id,
                    'item' => $OErequired[$i],
                    'currency' => $data['quot']->currency_id,
                    'price' => 0,
                    'quantity' => 0,
                    'duration' => 0,
                    'amount' => 0,
                    'remarks' => ''
                );
            }

            OtherExpenses::insert($dOE);
        }


        return view('quotation/basket', $data);
    }

    // Delete
    public function delete(Request $request, $id)
    {
        if($id){
            $fc = Quotation::find($id);
            $fc->delete();

            return response()->json(array('success' => true));
        }
    }

    public function download(Request $request, $id, $type = 'pdf')
    {

        if(!$id){
            return redirect('quotation');
        }

        $data['quot'] = Quotation::find($id);
        $data['title'] = $data['quot']->tour_name;

        if($type == 'pdf'){
          return view('quotation/download_pdf', $data);
        }else if($type == 'xls'){
          abort(404);
        }
    }

    // Fixed Cost
    public function fixedCost(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation');
        }

        $data['quotation'] = Quotation::find($id);
        $data['fixedCost'] = FixedCost::where('quotation_id', $id)->get();
        $data['title'] = 'Fixed Cost';
        $data['url_back'] = url('quotation/basket/'.$id);

        if($data['quotation']->sum_fixed_cost() == 0){
            $dQFill = array(
                'fixed_cost_completed' => 0,
                'fixed_cost_errors' => ''
            );
        }else{
            $dQFill = array(
                'fixed_cost_completed' => 1,
                'fixed_cost_errors' => ''
            );
        }

        $qFill = QuotationFill::where('quotation_id', $id)->update($dQFill);

        return view('quotation/fixedCost/index', $data);
    }
    // Create
    public function createFixedCost(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation/'.$id.'/fixedcost');
        }

        $data['quotation'] = Quotation::find($id);
        $data['items'] = QuotationItems::where('block', 1)->orderBy('name', 'asc')->get();
        $data['title'] = 'Add Fixed Cost';
        return view('quotation/fixedCost/create', $data);
    }

    public function doCreateFixedCost(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation/'.$id.'/fixedcost');
        }

        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'duration' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('quotation/'.$id.'/fixedcost/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $quotation = Quotation::find($id);

        $fc = new FixedCost;
        $fc->quotation_id = $id;
        $fc->currency = $quotation->currency_id;
        $fc->item = $request->item;
        $fc->price = str_replace(',', '', $request->price);
        $fc->quantity = $request->quantity;
        $fc->duration = $request->duration;
        $fc->amount = str_replace(',', '', $request->amount);
        $fc->remarks = $request->remarks;
        $fc->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('quotation/'.$id.'/fixedcost');
    }

    // Update
    public function updateFixedCost(Request $request, $id)
    {
        if(!$id){
            return redirect()->back();
        }

        $data['fc'] = FixedCost::find($id);
        $data['items'] = QuotationItems::orderBy('name', 'asc')->get();
        $data['title'] = 'Edit Fixed Cost Item';
        return view('quotation/fixedCost/update', $data);
    }

    public function doUpdateFixedCost(Request $request, $id)
    {
        if(!$id){
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'duration' => 'required',
            'amount' => 'required'
        ]);

        $fc = FixedCost::find($id);

        if ($validator->fails()) {
            return redirect('quotation/fixedcost/update/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $fc->item = $request->item;
        $fc->price = str_replace(',', '', $request->price);
        $fc->quantity = $request->quantity;
        $fc->duration = $request->duration;
        $fc->amount = str_replace(',', '', $request->amount);
        $fc->remarks = $request->remarks;
        $fc->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('quotation/'.$fc->quotation_id.'/fixedcost');
    }

    // Delete
    public function deleteFixedCost(Request $request, $id)
    {
        if($id){
            $fc = FixedCost::find($id);
            $fc->delete();

            return response()->json(array('success' => true));
        }
    }

    /**
     * Variable Cost
     */

    public function variableCost(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation');
        }

        $data['quotation'] = Quotation::find($id);
        $data['variableCost'] = VariableCost::where('quotation_id', $id)->paginate(10);
        $data['title'] = 'Variable Cost';
        $data['url_back'] = url('quotation/basket/'.$id);

        if($data['quotation']->sum_variable_cost() == 0){
            $dQFill = array(
                'variable_cost_completed' => 0,
                'variable_cost_errors' => ''
            );
        }else{
            $dQFill = array(
                'variable_cost_completed' => 1,
                'variable_cost_errors' => ''
            );
        }

        $qFill = QuotationFill::where('quotation_id', $id)->update($dQFill);

        return view('quotation/variableCost/index', $data);
    }
    // Create
    public function createVariableCost(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation/'.$id.'/variablecost');
        }

        $data['quotation'] = Quotation::find($id);
        $data['items'] = QuotationItems::where('block', 2)->orderBy('name', 'asc')->get();
        $data['title'] = 'Add Variable Cost';
        return view('quotation/variableCost/create', $data);
    }

    public function doCreateVariableCost(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation/'.$id.'/variablecost');
        }

        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'duration' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('quotation/'.$id.'/variablecost/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $quotation = Quotation::find($id);

        $vc = new VariableCost;
        $vc->quotation_id = $id;
        $vc->currency = $quotation->currency_id;
        $vc->item = $request->item;
        $vc->price = str_replace(',', '', $request->price);
        $vc->quantity = $request->quantity;
        $vc->duration = $request->duration;
        $vc->amount = str_replace(',', '', $request->amount);
        $vc->remarks = $request->remarks;
        $vc->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('quotation/'.$id.'/variablecost');
    }

    // Update
    public function updateVariableCost(Request $request, $id)
    {
        if(!$id){
            return redirect()->back();
        }

        $data['vc'] = VariableCost::find($id);
        $data['items'] = QuotationItems::orderBy('name', 'asc')->get();
        $data['title'] = 'Edit Variable Cost Item';
        return view('quotation/variableCost/update', $data);
    }

    public function doUpdateVariableCost(Request $request, $id)
    {
        if(!$id){
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'duration' => 'required',
            'amount' => 'required'
        ]);

        $vc = VariableCost::find($id);

        if ($validator->fails()) {
            return redirect('quotation/variablecost/update/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $vc->item = $request->item;
        $vc->price = str_replace(',', '', $request->price);
        $vc->quantity = $request->quantity;
        $vc->duration = $request->duration;
        $vc->amount = str_replace(',', '', $request->amount);
        $vc->remarks = $request->remarks;
        $vc->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('quotation/'.$vc->quotation_id.'/variablecost');
    }

    // Delete
    public function deleteVariableCost(Request $request, $id)
    {
        if($id){
            $vc = VariableCost::find($id);
            $vc->delete();

            return response()->json(array('success' => true));
        }
    }


    /**
     * Other Expenses
     */

    public function otherExpenses(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation');
        }

        $data['quotation'] = Quotation::find($id);
        $data['otherExpenses'] = OtherExpenses::where('quotation_id', $id)->paginate(10);
        $data['title'] = 'Other Expenses';
        $data['url_back'] = url('quotation/basket/'.$id);

        if($data['quotation']->sum_variable_cost() == 0){
            $dQFill = array(
                'other_expenses_completed' => 0,
                'other_expenses_errors' => ''
            );
        }else{
            $dQFill = array(
                'other_expenses_completed' => 1,
                'other_expenses_errors' => ''
            );
        }

        $qFill = QuotationFill::where('quotation_id', $id)->update($dQFill);

        return view('quotation/otherExpenses/index', $data);
    }
    // Create
    public function createOtherExpenses(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation/'.$id.'/otherexpenses');
        }

        $data['quotation'] = Quotation::find($id);
        $data['items'] = QuotationItems::where('block', 3)->orderBy('name', 'asc')->get();
        $data['title'] = 'Add Other Expenses';
        return view('quotation/otherExpenses/create', $data);
    }

    public function doCreateOtherExpenses(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation/'.$id.'/otherexpenses');
        }

        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'duration' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('quotation/'.$id.'/otherexpenses/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $quotation = Quotation::find($id);

        $oe = new OtherExpenses;
        $oe->quotation_id = $id;
        $oe->currency = $quotation->currency_id;
        $oe->item = $request->item;
        $oe->price = str_replace(',', '', $request->price);
        $oe->quantity = $request->quantity;
        $oe->duration = $request->duration;
        $oe->amount = str_replace(',', '', $request->amount);
        $oe->remarks = $request->remarks;
        $oe->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('quotation/'.$id.'/otherexpenses');
    }

    // Update
    public function updateOtherExpenses(Request $request, $id)
    {
        if(!$id){
            return redirect()->back();
        }

        $data['oe'] = OtherExpenses::find($id);
        $data['items'] = QuotationItems::orderBy('name', 'asc')->get();
        $data['title'] = 'Edit Other Expenses Item';
        return view('quotation/otherExpenses/update', $data);
    }

    public function doUpdateOtherExpenses(Request $request, $id)
    {
        if(!$id){
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'duration' => 'required',
            'amount' => 'required'
        ]);

        $oe = OtherExpenses::find($id);

        if ($validator->fails()) {
            return redirect('quotation/otherexpenses/update/'.$id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $oe->item = $request->item;
        $oe->price = str_replace(',', '', $request->price);
        $oe->quantity = $request->quantity;
        $oe->duration = $request->duration;
        $oe->amount = str_replace(',', '', $request->amount);
        $oe->remarks = $request->remarks;
        $oe->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');
        return redirect('quotation/'.$oe->quotation_id.'/otherexpenses');
    }

    // Delete
    public function deleteOtherExpenses(Request $request, $id)
    {
        if($id){
            $oe = OtherExpenses::find($id);
            $oe->delete();

            return response()->json(array('success' => true));
        }
    }


    /**
     * Land Arrangement
     */

    public function landArrangement(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation');
        }

        $data['quotation'] = Quotation::find($id);
        $data['landArrangement'] = LandArrangement::where('quotation_id', $id)->paginate(10);
        $data['url_back'] = url('quotation/basket/'.$id);

        if($data['quotation']->sum_land_arrangement() == 0){
            $dQFill = array(
                'land_arrangement_completed' => 0,
                'land_arrangement_errors' => ''
            );
        }else{
            $dQFill = array(
                'land_arrangement_completed' => 1,
                'land_arrangement_errors' => ''
            );
        }

        $qFill = QuotationFill::where('quotation_id', $id)->update($dQFill);

        if($request->mode == 'manual'){
            $data['title'] = '[Manual] Land Arrangement';
            return view('quotation/landArrangement/index_manual', $data);
        }else{
            $data['title'] = 'Land Arrangement';
            return view('quotation/landArrangement/index', $data);
        }
    }
    // Create
    public function createLandArrangement(Request $request, $id)
    {

        if(!$id){
            return redirect('quotation/'.$id.'/landarrangement');
        }

        $data['quotation'] = Quotation::find($id);
        $data['items'] = QuotationItems::where('block', 4)->orderBy('name', 'asc')->get();
        $data['hotels'] = Hotel::orderBy('name', 'asc')->get();

        if($request->mode == 'manual'){
            $data['title'] = '[Manual] Add Land Arrangement Item';
            return view('quotation/landArrangement/create_manual', $data);
        }else{
            $data['title'] = 'Add Land Arrangement';
            return view('quotation/landArrangement/create', $data);
        }
    }

    public function doCreateLandArrangement(Request $request, $id)
    {
        if(!$id){
            return redirect('quotation/'.$id.'/landarrangement');
        }

        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'duration' => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $quotation = Quotation::find($id);

        $la = new LandArrangement;
        $la->quotation_id = $id;
        $la->currency = $quotation->currency_id;
        $la->item = $request->item;
        $la->price = str_replace(',', '', $request->price);
        $la->quantity = $request->quantity;
        $la->duration = $request->duration;
        $la->amount = str_replace(',', '', $request->amount);
        $la->remarks = $request->remarks;
        $la->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');

        if($request->mode == 'manual'){
            return redirect('quotation/'.$id.'/landarrangement?mode=manual');
        }else{
            return redirect('quotation/'.$id.'/landarrangement');
        }
    }

    // Update
    public function updateLandArrangement(Request $request, $id)
    {
        if(!$id){
            return redirect()->back();
        }

        $data['la'] = LandArrangement::find($id);
        $data['items'] = QuotationItems::where('block', 4)->orderBy('name', 'asc')->get();
        $data['title'] = 'Edit Land Arrangement Item';

        if($request->mode == 'manual'){
            $data['title'] = '[Manual] Edit Land Arrangement Item';
            return view('quotation/landArrangement/update_manual', $data);
        }else{
            $data['title'] = 'Edit Land Arrangement';
            return view('quotation/landArrangement/update', $data);
        }
    }

    public function doUpdateLandArrangement(Request $request, $id)
    {
        if(!$id){
            return redirect()->back();
        }

        $validator = Validator::make($request->all(), [
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'duration' => 'required',
            'amount' => 'required'
        ]);

        $la = LandArrangement::find($id);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $la->item = $request->item;
        $la->price = str_replace(',', '', $request->price);
        $la->quantity = $request->quantity;
        $la->duration = $request->duration;
        $la->amount = str_replace(',', '', $request->amount);
        $la->remarks = $request->remarks;
        $la->save();

        $request->session()->flash('msg', 'Data berhasil disimpan!');

        if($request->mode == 'manual'){
            return redirect('quotation/'.$la->quotation_id.'/landarrangement?mode=manual');
        }else{
            return redirect('quotation/'.$la->quotation_id.'/landarrangement');
        }
    }

    // Delete
    public function deleteLandArrangement(Request $request, $id)
    {
        if($id){
            $la = LandArrangement::find($id);
            $la->delete();

            return response()->json(array('success' => true));
        }
    }
}
