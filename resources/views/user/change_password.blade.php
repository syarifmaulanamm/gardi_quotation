@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif

<form action="{{ url('user/update/'.$user->id) }}" method="post">
{{ csrf_field() }}
<input type="hidden" name="mode" value="password">
  <div class="form-group">
    <label>Old Password</label>
    <input type="password" class="form-control" name="old_password">
  </div>
  <div class="form-group">
    <label>New Password</label>
    <input type="password" class="form-control" name="new_password">
  </div>
  <div class="form-group">
    <label>Confirm Password</label>
    <input type="password" class="form-control" name="re_password">
  </div>
  <button class="btn btn-primary btn-fill" type="submit"><i class="ion-checkmark-round"></i> Save Changes</button>
</form>
@endsection
