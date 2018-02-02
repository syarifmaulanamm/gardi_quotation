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
        <label>Name Of Tour</label>
        <input type="text" name="name" class="form-control" required autofocus>
    </div>
    <div class="form-group">
        <label>Category</label>
        <select name="category" class="form-control" required>
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
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection