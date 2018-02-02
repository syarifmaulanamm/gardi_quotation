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
        <label>Type</label>
        <input type="text" name="type" class="form-control" value="{{ $roomType->type }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection