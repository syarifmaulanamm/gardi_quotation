@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif
<form action="" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
    <div class="form-group">
        <label>Name Of Hotel</label>
        <input type="text" name="name" class="form-control" required autofocus>
    </div>
    <div class="form-group">
        <label>Stars</label>
        <input name="stars" type="number" step="1" class="rating" data-size="sm" >
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="form-group">
        <label>Address</label>
        <textarea name="address" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label>Features</label>
        <select class="form-control selectpicker" name="feature[]" multiple data-actions-box="true">
            <option value="Free Wifi">Free Wifi</option>
            <option value="Free Parking">Free Parking</option>
            <option value="Free Breakfast">Free Breakfast</option>
            <option value="Swimming Pool">Swimming Pool</option>
            <option value="SPA">SPA</option>
        </select>

    </div>
    <!-- <div class="form-group">
        <label>Image</label>
        <small>Ukuran gambar 300 x 300px</small>
        <input type="file" name="image" class="form-control">
    </div> -->
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        
    });
</script>
@endsection