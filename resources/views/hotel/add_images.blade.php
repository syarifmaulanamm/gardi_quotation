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
        <input type="file" name="image" class="form-control">
        <small><strong>File Type : </strong><em>jpg, jpeg, png, svg, gif</em>, <strong>File Size : </strong><em>300 x 300 px</em></small>
    </div>
    <button type="submit" class="btn btn-primary">Upload Now</button>
</form>
@endsection