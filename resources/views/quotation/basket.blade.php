@extends('themes.default')

@section('title', $title)

@section('content')
<div class="alert alert-danger" id="alert"></div>
<form action="{{ url('quotation/update') }}" method="post">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Name Of Tour</label>
            <input type="text" name="tour_name" class="form-control" value="{{ $quot->tour_name }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Category</label>
            <select name="category" class="form-control" required>
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
            <select name="currency" class="form-control" required>
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
        <div class="card" id="fc">
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
        <div class="card muted" id="vc">
            <div class="header">
                <h4 class="title">Variable Cost</h4>
            </div>
            <div class="content">   
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>{{ number_format($quot->sum_variable_cost(), 0, ',', ',') }}</p>
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
        <div class="card muted" id="oe">
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
        <div class="card muted" id="la">
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
        <div class="card muted" id="summary">
            <div class="header">
                <h4 class="title">Summary</h4>
            </div>
            <div class="content">   
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Incentive Staff</label>
                            <select name="incentive_staff" class="form-control">
                                <option value="10000">10,000 (Domestic)</option>
                                <option value="15000">15,000 (Asean)</option>
                                <option value="50000">50,000 (Asia, Middle East & Umrah Promo)</option>
                                <option value="60000">60,000 (Aussie & New Zealand)</option>
                                <option value="80000">80,000 (Europe & Africa)</option>
                                <option value="100000">100,000 (USA, Canada, Leisure Series, Umrah Reguler & Plus)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Commission Sales</label>
                            <select name="commission_sales" class="form-control">
                                <option value="30000">30,000 (Domestic)</option>
                                <option value="50000">50,000 (Asean)</option>
                                <option value="100000">100,000 (Asia, Middle East, Aussie & New Zealand)</option>
                                <option value="200000">200,000 (USA, Canada, Europe & Africa)</option>
                                <option value="500000">500,000 (Leisure Series & Umrah Promo)</option>
                                <option value="1000000">1,000,000 (Umrah Reguler & Plus)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>CN</label>
                            <input type="text" name="cn" class="form-control currency">
                        </div>
                        <div class="form-group">
                            <label>Profit</label>
                            <select name="profit" class="form-control">
                                <option value="15">15%</option>
                                <option value="16">16%</option>
                                <option value="17">17%</option>
                                <option value="18">18%</option>
                                <option value="19">19%</option>
                                <option value="20">20%</option>
                                <option value="21">21%</option>
                                <option value="22">22%</option>
                                <option value="23">23%</option>
                                <option value="24">24%</option>
                                <option value="25">25%</option>
                                <option value="26">26%</option>
                                <option value="27">27%</option>
                                <option value="28">28%</option>
                                <option value="29">29%</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <table class="table table-responsive table-bordered">
                    <tr>
                        <th>Net Per Pax</th>
                        <th>Selling Price</th>
                    </tr>
                    <tr>
                        <td rowspan="2"><h2>10,000</h2></td>
                        <td>PPN 1% = 120</td>
                    </tr>
                    <tr>
                        <td><h2>12,000</h2></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="pull-right">
    <button class="btn btn-primary" disabled><i class="ion-checkmark-round"></i> Save Changes</button>
</div>
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
        @else
        $("#la").addClass('danger');
        @endif
    }
}
</script>
@endsection