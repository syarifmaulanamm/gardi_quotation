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
        <input type="text" name="tour_name" class="form-control" required autofocus>
    </div>
    <div class="form-group">
        <label>Category</label>
        <select name="category_id" class="form-control" required>
            @foreach($category as $item)
            <option value="{{ $item->id }}">{{ ucwords($item->name) }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Number Of Pax</label>
        <input type="number" name="number_of_pax" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Currency</label>
        <select name="currency_id" class="form-control" required>
        @foreach($currency as $item)
        <option value="{{ $item->id }}">{{ '('.ucwords($item->code.') '.$item->name) }}</option>
        @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Validity</label>
        <div class='input-group'>
            <input type='date' name="validity" class="form-control" />
            <span class="input-group-addon">
                <span class="ion-calendar"></span>
            </span>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection