@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif

<div class="card">
  <div class="content text-center">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <form action="{{ url('user/update/'.$user->id) }}" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="mode" value="avatar">
          <div class="form-group">
            <img id="img-preview" src="@if($user->avatar != '') {{ asset('assets/img/users-avatar/'.$user->avatar) }} @else {{ asset('assets/img/default-avatar.png') }} @endif" class="img-thumbnail">
            <br><br>
            <input type="file" class="form-control" onchange="readURL(this);" name="image">
          </div>
          <button class="btn btn-primary btn-fill" type="submit"><i class="ion-checkmark-round"></i> Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img-preview')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
