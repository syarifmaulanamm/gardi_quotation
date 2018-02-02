@extends('themes.default')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-md-4">
        <a href="{{ url('currency') }}" class="btn btn-lg btn-block btn-default"><i class="ion-social-usd"></i> Currency</a>
    </div>
    <div class="col-md-4">
        <a href="{{ url('hotel/room-type') }}" class="btn btn-lg btn-block btn-default text-center"><i class="fa fa-bed"></i> Room Type</a>
    </div>
    <div class="col-md-4">
        <a href="{{ url('hotel/bed-type') }}" class="btn btn-lg btn-block btn-default text-center"><i class="fa fa-bed"></i> Bed Type</a>
    </div>
</div>
@endsection