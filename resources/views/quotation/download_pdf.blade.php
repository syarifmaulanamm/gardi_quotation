@extends('themes.blank')

@section('title', $title)

@section('content')
<style>
    body {
        font-size : 8pt;
    }
</style>

<h3 class="text-center">GARDI'S QUOTATION FORM</h3>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <table class="table table-bordered table-condensed">
            <tr>
                <th>NAME OF TOUR</th>
                <td>{{ $quot->tour_name }}</td>
            </tr>
            <tr>
                <th>CATEGORY</th>
                <td>{{ $quot->cat->name }}</td>
            </tr>
            <tr>
                <th>NUMBER OF PAX</th>
                <td>{{ $quot->number_of_pax }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <table class="table table-bordered table-condensed">
            <tr>
                <th>CURRENCY</th>
                <td>{{ $quot->cur->code }} ({{ $quot->cur->name }})</td>
            </tr>
            <tr>
                <th>VALIDITY</th>
                <td>{{ date('d-m-Y', strtotime($quot->validity)) }}</td>
            </tr>
            <tr>
                <th>PREPARED BY</th>
                <td>{{ $quot->author->fullname }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th colspan="5" class="text-center"><strong>FIXED COST</strong></th>
                </tr>
                <tr>
                    <th rowspan="2">ITEMS</th>
                    <th colspan="3">DESCRIPTION</th>
                    <th rowspan="2">AMOUNT</th>
                </tr>
                <tr>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>DUR</th>
                </tr>
            </thead>
            <tbody>
            @foreach($quot->fixed_cost as $item)
            <tr>
                    <td><strong>{{ $item->item }}</strong> <br> {{ $item->remarks }}</td>
                    <td>{{ number_format($item->price, 0, ',', ',') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->duration }}</td>
                    <td class="text-right">{{ number_format($item->amount, 0, ',', ',') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th colspan="5" class="text-center"><strong>VARIABLE COST</strong></th>
                </tr>
                <tr>
                    <th rowspan="2">ITEMS</th>
                    <th colspan="3">DESCRIPTION</th>
                    <th rowspan="2">AMOUNT</th>
                </tr>
                <tr>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>DUR</th>
                </tr>
            </thead>
            <tbody>
            @foreach($quot->variable_cost as $item)
            <tr>
                    <td><strong>{{ $item->item }}</strong> <br> {{ $item->remarks }}</td>
                    <td>{{ number_format($item->price, 0, ',', ',') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->duration }}</td>
                    <td class="text-right">{{ number_format($item->amount, 0, ',', ',') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th colspan="5" class="text-center"><strong>OTHER EXPENSES</strong></th>
                </tr>
                <tr>
                    <th rowspan="2">ITEMS</th>
                    <th colspan="3">DESCRIPTION</th>
                    <th rowspan="2">AMOUNT</th>
                </tr>
                <tr>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>DUR</th>
                </tr>
            </thead>
            <tbody>
            @foreach($quot->other_expenses as $item)
            <tr>
                    <td><strong>{{ $item->item }}</strong> <br> {{ $item->remarks }}</td>
                    <td>{{ number_format($item->price, 0, ',', ',') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->duration }}</td>
                    <td class="text-right">{{ number_format($item->amount, 0, ',', ',') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th colspan="5" class="text-center"><strong>LAND ARRANGEMENT</strong></th>
                </tr>
                <tr>
                    <th rowspan="2">ITEMS</th>
                    <th colspan="3">DESCRIPTION</th>
                    <th rowspan="2">AMOUNT</th>
                </tr>
                <tr>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>DUR</th>
                </tr>
            </thead>
            <tbody>
            @foreach($quot->land_arrangement as $item)
            <tr>
                    <td><strong>{{ $item->item }}</strong> <br> {{ $item->remarks }}</td>
                    <td>{{ number_format($item->price, 0, ',', ',') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->duration }}</td>
                    <td class="text-right">{{ number_format($item->amount, 0, ',', ',') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <table class="table table-bordered table-condensed">
            <tr>
                <th>TOTAL LAND COST</th>
                <td class="text-right">{{ number_format($quot->sum_land_arrangement(), 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>TOTAL FIXED COST</th>
                <td class="text-right">{{ number_format($quot->sum_fixed_cost(), 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>TOTAL VARIABLE COST</th>
                <td class="text-right">{{ number_format(($quot->sum_variable_cost() / $quot->number_of_pax), 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>TOTAL OTHER EXPENSES</th>
                <td class="text-right">{{ number_format($quot->sum_other_expenses(), 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>INCENTIVE STAFF</th>
                <td class="text-right">{{ number_format($quot->incentive_staff, 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>COMMISSION SALES</th>
                <td class="text-right">{{ number_format($quot->commission_sales, 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>CREDIT NOTE (CN)</th>
                <td class="text-right">{{ number_format($quot->cn, 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>PROFIT</th>
                <td class="text-right">{{ number_format($quot->profit, 0, ',', ',') }}%</td>
            </tr>
            <tr>
                <th>NET PER PAX</th>
                <td class="text-right">{{ number_format($quot->net_per_pax, 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>PPN 1%</th>
                <td class="text-right">{{ number_format($quot->ppn1, 0, ',', ',') }}</td>
            </tr>
            <tr>
                <th>SELLING PRICE</th>
                <td class="text-right"><h3><strong>{{ number_format($quot->selling_price, 0, ',', ',') }}</strong></h3></td>
            </tr>
        </table>
    </div>
</div>
@endsection
@section('js')
<script>
  window.print();
</script>
@endsection
