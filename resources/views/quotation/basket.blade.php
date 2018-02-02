@extends('themes.default')

@section('title', $title)

@section('content')
<form action="{{ url('quotation/update') }}" method="post">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Category</label>
            <select name="category" class="form-control" required>
                <option value="0">Select Category</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Currency</label>
            <select name="currency" class="form-control" required>
                <option value="0">Select Currency</option>
                <option value="idr">IDR</option>
                <option value="usd">USD</option>
                <option value="eur">EURO</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Validity</label>
            <div class='input-group'>
                <input type='date' name="validity" class="form-control" />
                <span class="input-group-addon">
                    <span class="ion-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ Session::get('login_data')['fullname'] }}" readonly>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title">Fixed Cost</h4>
            </div>
            <div class="content">   
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>20,000</p>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li><a href="{{ url('quotations/fixedcost/update') }}" class="btn-cog"><i class="ion-gear-b"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title">Variable Cost</h4>
            </div>
            <div class="content">   
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>20,000</p>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li><a href="{{ url('quotations/variablecost/update') }}" class="btn-cog"><i class="ion-gear-b"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title">Other Expenses</h4>
            </div>
            <div class="content">   
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>20,000</p>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li><a href="{{ url('quotations/otherexpensive/update') }}" class="btn-cog"><i class="ion-gear-b"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h4 class="title">Land Arrangement</h4>
            </div>
            <div class="content">   
                <div class="footer">
                    <hr>
                    <div class="category">
                        <p>20,000</p>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li><a href="{{ url('quotations/fixedcost/update') }}" class="btn-cog"><i class="ion-gear-b"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Summary</h4>
            </div>
            <div class="content">   
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Miscellaneous</label>
                            <input type="text" name="miscellaneous" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>CN</label>
                            <input type="text" name="cn" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Incentive</label>
                            <input type="text" name="incentive" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Agent Comms</label>
                            <input type="text" name="agent_comms" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Discount</label>
                            <input type="text" name="discount" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Profit</label>
                            <input type="text" name="profit" class="form-control">
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
    <button class="btn btn-primary"><i class="ion-checkmark-round"></i> Save Changes</button>
</div>
</form>
@endsection