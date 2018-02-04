@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif
<form action="{{ url()->current() }}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ $room->name }}" required autofocus>
    </div>
    <div class="form-group">
        <label>Room Type</label>
        <select name="room_type" class="form-control" required>
            <option value="0">Select Type</option>
            @foreach($roomType as $item)
            <option value="{{ $item->id }}" @if($room->room_type == $item->id) selected @endif>{{ $item->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Bed Type</label>
        <select name="bed_type" class="form-control" required>
            <option value="0">Select Type</option>
            @foreach($bedType as $item)
            <option value="{{ $item->id }}" @if($room->bed_type == $item->id) selected @endif>{{ $item->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Capacity</label>
        <input type="number" name="capacity" min="1" max="4" value="{{ $room->capacity }}" class="form-control">
    </div>    
    <div class="form-group">
        <label>Currency</label>
        <select name="currency" class="form-control" required>
            <option value="0">Select Currency</option>
            @foreach($currency as $item)
            <option value="{{ $item->id }}"  @if($room->currency == $item->id) selected @endif>{{ '('.$item->code.') '.$item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input name="price" class="form-control currency" value="{{ $room->price }}">
    </div>
    <div class="form-group">
        <label>Validity</label>
        <input type="date" name="validity" value="{{ $room->validity }}" class="form-control">
    </div>
    <div class="form-group">
        <label>Remarks</label>
        <textarea name="remarks" class="form-control" rows="5">{{ $room->remarks }}</textarea>
    </div>
    <div class="form-group">
        <label>Image</label>
        <br>
        <img src="{{ asset('storage/images/hotel/'.$room->images[0]) }}" class="img-rounded" alt="{{ $room->name }}" width="200px">
        <br>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection