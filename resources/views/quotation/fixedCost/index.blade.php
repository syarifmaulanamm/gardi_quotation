@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif
<div class="card">
    <div class="content table-responsive table-full-width">
        <table class="table table-hover table-striped">
            <thead>
                <th>Item</th>
                <th>Currency</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Dur</th>
                <th>Amount</th>
                <th class="text-center" width="200">Action</th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" colspan="7">
                        <a href="{{ url('quotation/'.$quotation->id.'/fixedcost/create') }}" class="btn btn-round btn-primary"><i class="ion-plus"></i> Add Fixed Cost</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection