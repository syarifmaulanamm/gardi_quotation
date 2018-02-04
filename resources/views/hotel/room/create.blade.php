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
        <input type="text" name="name" class="form-control" required autofocus>
    </div>
    <div class="form-group">
        <label>Room Type</label>
        <select name="room_type" class="form-control" required>
            <option value="0">Select Type</option>
            @foreach($roomType as $item)
            <option value="{{ $item->id }}">{{ $item->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Bed Type</label>
        <select name="bed_type" class="form-control" required>
            <option value="0">Select Type</option>
            @foreach($bedType as $item)
            <option value="{{ $item->id }}">{{ $item->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Capacity</label>
        <input type="number" name="capacity" min="1" max="4" class="form-control">
    </div>    
    <div class="form-group">
        <label>Currency</label>
        <select name="currency" class="form-control" required>
            <option value="0">Select Currency</option>
            @foreach($currency as $item)
            <option value="{{ $item->id }}">{{ '('.$item->code.') '.$item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input name="price" class="form-control currency">
    </div>
    <div class="form-group">
        <label>Validity</label>
        <input type="date" name="validity" class="form-control">
    </div>
    <div class="form-group">
        <label>Remarks</label>
        <textarea name="remarks" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $("#capacity").change(function(){
            var indicator = '';
            var $this = $(this);
            var max = 4;
            var val = $this.val();

            for(var i = 0; i < val; i++){
                indicator += "<i class='ion-ios-person' style='color:#505050;font-size:20pt;'></i>";
            }
            for(var i = 0; i < (max-val); i++){
                indicator += "<i class='ion-ios-person' style='color:#e0e0e0;font-size:20pt;'></i>";
            }

            $("#capacity-indicator").html(indicator);
        });
    });
</script>
@endsection