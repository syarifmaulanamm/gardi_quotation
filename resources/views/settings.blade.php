@extends('themes.default')

@section('title', $title)

@section('content')
<style>
.menu-grid .col-md-4 {
    margin-bottom: 30px;
}
</style>
<div class="row menu-grid">
    <div class="col-md-4">
        <a href="{{ url('currency') }}" class="btn btn-lg btn-block btn-fill btn-success"><i class="ion-social-usd"></i> Currency</a>
    </div>
    <div class="col-md-4">
        <a href="{{ url('hotel/room-type') }}" class="btn btn-lg btn-block btn-fill btn-success"><i class="fa fa-bed"></i> Room Type</a>
    </div>
    <div class="col-md-4">
        <a href="{{ url('hotel/bed-type') }}" class="btn btn-lg btn-block btn-fill btn-success"><i class="fa fa-bed"></i> Bed Type</a>
    </div>
    <div class="col-md-4">
        <a href="{{ url('quotation/items') }}" class="btn btn-lg btn-block btn-fill btn-success"><i class="ion-clipboard"></i> Quotation Items</a>
    </div>
    <div class="col-md-4">
        <a href="{{ url('quotation/items') }}" class="btn btn-lg btn-block btn-fill btn-success"><i class="ion-clipboard"></i> Quotation Items</a>
    </div>
</div>
@endsection