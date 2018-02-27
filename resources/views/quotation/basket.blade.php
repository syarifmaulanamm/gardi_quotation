@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif

<form action="{{ url('quotation/update/'.$quot->id) }}" method="post">
{{ csrf_field() }}
<div class="row" data-step="1" data-intro="Quotation Details">
    <div class="col-md-4">
        <div class="form-group">
            <label>Name Of Tour</label>
            <input type="text" name="tour_name" class="form-control" value="{{ $quot->tour_name }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
            @foreach($category as $item)
            <option value="{{ $item->id }}" @if($quot->category_id == $item->id) selected @endif >{{ ucwords($item->name) }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Number Of Pax</label>
            <input type="number" name="number_of_pax" class="form-control" value="{{ $quot->number_of_pax }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Currency</label>
            <select name="currency_id" class="form-control" required>
            @foreach($currency as $item)
            <option value="{{ $item->id }}" @if($quot->currency_id == $item->id) selected @endif >{{ '('.ucwords($item->code.') '.$item->name) }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Validity</label>
            <div class='input-group'>
                <input type='date' name="validity" value="{{ $quot->validity }}" class="form-control" />
                <span class="input-group-addon">
                    <span class="ion-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ $quot->author->fullname }}" readonly>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="card" id="fc" data-step="2" data-intro="Fixed Cost : Biaya tetap yang tidak berubah karena frekuensi atau jumlah.">
            <div class="header">
                <h4 class="title">Fixed Cost</h4>
            </div>
            <div class="content">
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>{{ number_format($quot->sum_fixed_cost(), 0, ',', ',') }}</p>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li><a href="{{ url('quotation/'.$quot->id.'/fixedcost') }}" class="btn-cog"><i class="ion-gear-b fa fa-spin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card muted" id="vc" data-step="3" data-intro="Variable Cost : Biaya yang berubah karena jumlah atau frekuensi, sifatnya perorangan.">
            <div class="header">
                <h4 class="title">Variable Cost</h4>
            </div>
            <div class="content">
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>{{ number_format(($quot->sum_variable_cost() / $quot->number_of_pax), 0, ',', ',') }}</p>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li><a href="{{ url('quotation/'.$quot->id.'/variablecost') }}" class="btn-cog"><i class="ion-gear-b fa fa-spin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card muted" id="oe" data-step="4" data-intro="Other Expenses">
            <div class="header">
                <h4 class="title">Other Expenses</h4>
            </div>
            <div class="content">
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>{{ number_format($quot->sum_other_expenses(), 0, ',', ',') }}</p>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li><a href="{{ url('quotation/'.$quot->id.'/otherexpenses') }}" class="btn-cog"><i class="ion-gear-b fa fa-spin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card muted" id="la" data-step="5" data-intro="Land Arrangement">
            <div class="header">
                <h4 class="title">Land Arrangement</h4>
            </div>
            <div class="content">
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>{{ number_format($quot->sum_land_arrangement(), 0, ',', ',') }}</p>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li><a href="#" data-toggle="modal" data-target="#laModal" class="btn-cog"><i class="ion-gear-b fa fa-spin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card muted" id="summary" data-step="6" data-intro="Tentukan Incentive Staff, Commission Sales, CN dan Profit. Dan dapatkan harga jual quotation Anda.">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Incentive Staff</label>
                            @if($quot->cur->code == 'IDR')
                              <select name="incentive_staff" class="form-control">
                              @foreach($ar_incentive as $item)
                              <option value="{{ $item['nominal'] }}" @if($quot->incentive_staff == $item['nominal']) selected @endif>{{ $item['nominal'] }} {{ $item['description'] }}</option>
                              @endforeach
                              </select>
                            @elseif($quot->cur->code == 'USD')
                              <select name="incentive_staff" class="form-control">
                              @foreach($ar_incentive as $item)
                              <option value="{{ $item['nominal_usd'] }}" @if($quot->incentive_staff == $item['nominal_usd']) selected @endif>{{ $item['nominal_usd'] }} {{ $item['description'] }}</option>
                              @endforeach
                              </select>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Commission Sales</label>
                            @if($quot->cur->code == 'IDR')
                              <select name="commission_sales" class="form-control">
                              @foreach($ar_commission as $item)
                              <option value="{{ $item['nominal'] }}" @if($quot->incentive_staff == $item['nominal']) selected @endif>{{ $item['nominal'] }} {{ $item['description'] }}</option>
                              @endforeach
                              </select>
                            @elseif($quot->cur->code == 'USD')
                              <select name="commission_sales" class="form-control">
                              @foreach($ar_commission as $item)
                              <option value="{{ $item['nominal_usd'] }}" @if($quot->incentive_staff == $item['nominal_usd']) selected @endif>{{ $item['nominal_usd'] }} {{ $item['description'] }}</option>
                              @endforeach
                              </select>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>CN</label>
                            <input type="text" name="cn" value="0" class="form-control currency">
                        </div>
                        <div class="form-group">
                            <label>Profit</label>
                            <select name="profit" class="form-control">
                            @foreach($ar_profit as $k=>$v)
                            <option value="{{ $k }}" @if($quot->profit == $k) selected @endif>{{ $v }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-responsive table-striped">
                            <tr>
                                <th>Net Per Pax</th>
                                <td class="text-right"><span id="netPerPax">-</span></td>
                            </tr>
                            <tr>
                                <th>PPN 1%</th>
                                <td class="text-right"><span id="ppn">-</span></td>
                            </tr>
                            <tr>
                                <th>Selling Price</th>
                                <td class="text-right" style="color: #0984e3"><h2>{{ $quot->cur->code }} <span id="sellingPrice"></span></h2></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pull-right">
    <button class="btn btn-primary btn-fill" id="btnSave" disabled  data-step="7" data-intro="Klik untuk menyimpan perubahan"><i class="ion-checkmark-round"></i> Save Changes</button>
</div>

<!-- Default Value -->
<input type="hidden" value="{{ $quot->sum_fixed_cost() }}" id="valFC">
<input type="hidden" value="{{ $quot->sum_variable_cost() / $quot->number_of_pax }}" id="valVC">
<input type="hidden" value="{{ $quot->sum_other_expenses() }}" id="valOE">
<input type="hidden" value="{{ $quot->sum_land_arrangement() }}" id="valLA">
<input type="hidden" name="net_per_pax">
<input type="hidden" name="ppn1">
<input type="hidden" name="selling_price">
</form>

<!-- Modal -->
<div id="laModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body">
            <p class="text-center">Select Mode:</p>
            <a href="{{ url('quotation/'.$quot->id.'/landarrangement') }}" class="btn btn-block btn-primary btn-round"><i class="ion-cube"></i> Land Arrangement</a>
            <a href="{{ url('quotation/'.$quot->id.'/landarrangement?mode=manual') }}" class="btn btn-block btn-default btn-round">Manual</a>
        </div>
        <div class="modal-footer text-center">
            <button type="button" class="btn btn-block close" data-dismiss="modal">&times;</button>
        </div>
    </div>

    </div>
</div>
@endsection
@section('js')
<script>
$(document).ready(function(){
    $("#alert").css('display', 'none');
    $("#summary :input").prop("disabled", true);

    getPrice();

    $("body").on('change', 'input', function(){
        getPrice();
    });

    $("body").on('change', 'select', function(){
        getPrice();
    });

    @if(URL::previous() != url('quotation/create'))
    introJs().exit();
    @endif

    @if($qFill->fixed_cost_completed == NULL)
    doAct(1);
    @elseif($qFill->fixed_cost_completed != NULL && $qFill->variable_cost_completed == NULL)
    doAct(2);
    @elseif($qFill->variable_cost_completed != NULL && $qFill->other_expenses_completed == NULL)
    doAct(3);
    @elseif($qFill->other_expenses_completed != NULL && $qFill->land_arrangement_completed == NULL)
    doAct(4);
    @elseif($qFill->land_arrangement_completed != NULL && $qFill->summary_completed == NULL)
    doAct(5);
    @endif
});

function getPrice(){
    var fc = Math.ceil(parseInt($("#valFC").val()));
    var vc = Math.ceil(parseInt($("#valVC").val()));
    var oe = Math.ceil(parseInt($("#valOE").val()));
    var la = Math.ceil(parseInt($("#valLA").val()));
    var is = Math.ceil($("select[name='incentive_staff']").val());
    var cs = Math.ceil($("select[name='commission_sales']").val());
    var cn = Math.ceil($("input[name='cn']").val());
    var profit = Math.ceil(parseInt($("select[name='profit']").val()));

    // var net = Math.ceil(fc + vc + oe + la + is + cs + cn);
    var net = fc + vc + oe + la + is + cs + cn;
    var netProfit = Math.ceil(net + (net * profit / 100));
    var ppn = Math.ceil(netProfit * 1 / 100);
    var selling = Math.ceil(netProfit + ppn);

    $("#netPerPax").html($.number( netProfit, 0, ',' ));
    $("#ppn").html($.number( ppn, 0, ',' ));
    $("#sellingPrice").html($.number( selling, 0, ',' ));

    $("input[name='net_per_pax']").val($.number( netProfit, 0, ',' ));
    $("input[name='ppn1'").val($.number( ppn, 0, ',' ));
    $("input[name='selling_price']").val($.number( selling, 0, ',' ));

    console.log(is);
}

function doAct(step){
    if(step == 1){
        $("#fc").addClass('focus');
    }else if(step == 2){
        @if($qFill->fixed_cost_completed == 1)
        $("#vc").addClass('focus');
        $("#vc").removeClass('muted');
        $("#fc").removeClass('focus');
        @else
        $("#fc").addClass('danger');
        @endif
    }else if(step == 3){
        @if($qFill->variable_cost_completed == 1)
        $("#oe").addClass('focus');
        $("#oe").removeClass('muted');
        $("#vc").removeClass('muted');
        $("#vc").removeClass('focus');
        @else
        $("#vc").addClass('danger');
        @endif
    }else if(step == 4){
        @if($qFill->other_expenses_completed == 1)
        $("#la").addClass('focus');
        $("#la").removeClass('muted');
        $("#oe").removeClass('focus');
        $("#oe").removeClass('muted');
        $("#vc").removeClass('muted');
        @else
        $("#oe").addClass('danger');
        @endif
    }else if(step == 5){
        @if($qFill->land_arrangement_completed == 1)
        $("#summary").addClass('focus');
        $("#summary").removeClass('muted');
        $("#la").removeClass('muted');
        $("#la").removeClass('focus');
        $("#fc").removeClass('focus');
        $("#vc").removeClass('muted');
        $("#oe").removeClass('muted');
        $("#summary :input").prop("disabled", false);
        $("#btnSave").prop("disabled", false);
        @else
        $("#la").addClass('danger');
        @endif
    }
}
</script>
@endsection
