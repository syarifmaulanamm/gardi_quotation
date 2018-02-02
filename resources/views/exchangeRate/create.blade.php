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
        <label>From</label>
        <select name="from" class="form-control" required>
            @foreach($currency as $item)
                <option value="{{ $item->code }}">{{ '('.$item->code.') '.$item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>To</label>
        <select name="to" class="form-control" required>
            @foreach($currency as $item)
                <option value="{{ $item->code }}">{{ '('.$item->code.') '.$item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Rate</label>
        <input type="text" name="rate" class="form-control currency" required>
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection