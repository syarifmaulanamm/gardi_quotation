@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif
<form action="{{ url()->current() }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label>Item</label>
        <select name="item" class="form-control">
            @foreach($items as $item)
            <option value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Capacity</label>
        <input type="number" min="1" max="10" name="capacity" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection