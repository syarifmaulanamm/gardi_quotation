@extends('themes.default')

@section('title', $title)

@section('content')
<div class="row">
  <div class="col-md-2">
    <img src="@if($user->avatar != '') {{ asset('assets/img/users-avatar/'.$user->avatar) }} @else {{ asset('assets/img/default-avatar.png') }} @endif" class="img-thumbnail">
    <a href="{{ url('user/change-avatar/'.$user->id) }}" class="btn btn-default btn-sm btn-block">Change Avatar</a>
  </div>
  <form action="{{ url('user/update/'.$user->id) }}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="mode" value="full">
  <div class="col-md-5">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" value="{{ $user->username }}" readonly class="form-control">
    </div>
    <div class="form-group">
      <label>Full Name</label>
      <input type="text" name="fullname" value="{{ $user->fullname }}" class="form-control">
    </div>
    <div class="form-group">
      <label>Division</label>
      <select name="division" class="form-control">
        <option value=""></option>
        @foreach($division as $item)
        <option value="{{$item}}" @if($item == $user->division) selected @endif >{{ ucwords($item) }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-md-5">
    <div class="form-group">
      <label>Email</label>
      <input type="email" name="email" value="{{ $user->email }}" class="form-control">
    </div>
    <div class="form-group">
      <label>Phone</label>
      <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
    </div>
    <div class="form-group">
      <label>Level</label>
      <select name="level" class="form-control" @if(Session::get('login_data')['level'] != 1) readonly disabled @endif >
        <option value=""></option>
        @foreach($levels as $item)
        <option value="{{$item->id}}" @if($item->id == $user->level) selected @endif >{{ ucwords($item->name) }}</option>
        @endforeach
      </select>
    </div>

    <div class="pull-right">
      <button class="btn btn-primary btn-fill" type="submit"><i class="ion-checkmark-round"></i> Save Changes</button>
    </div>
  </div>
  </form>
</div>
@endsection


@section('js')
<script>
    $(document).ready(function(){
        @if(Session::has('msg'))
        $.notify({
            icon: 'ion-alert-circled',
            message: "{{ Session::get('msg') }}"

        },{
            type: 'info',
            timer: 4000
        });
        @endif
      });
</script>
@endsection
