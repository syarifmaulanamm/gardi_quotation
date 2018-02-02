@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif
<form action="" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label>Name Of Hotel</label>
        <input type="text" name="name" class="form-control" required autofocus>
    </div>
    <div class="form-group">
        <label>Stars</label>
        <input name="stars" type="text" class="rating" data-size="sm" >
    </div>
    <div class="form-group">
        <label>Number Of Room</label>
        <select name="number_of_room" class="form-control">
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <div class="form-group">
        <label>Room Type</label>
        <select name="room_type" class="form-control" required>
            <option value="0">Select Category</option>
        </select>
    </div>
    <div class="form-group">
        <label>Bed Type</label>
        <select name="bed_type" class="form-control" required>
            <option value="0">Select Category</option>
        </select>
    </div>
    <div class="form-group">
        <label>Currency</label>
        <select name="currency" class="form-control" required>
            <option value="0">Select Currency</option>
            <option value="idr">IDR</option>
            <option value="usd">USD</option>
            <option value="eur">EURO</option>
        </select>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input name="price" class="form-control money">
    </div>
    <div class="form-group">
        <label>Address</label>
        <textarea name="address" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection