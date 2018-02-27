@extends('themes.default')

@section('title', $title)

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ url()->current() }}">
                            <div class="input-group search-form">
                                <div class="input-group-addon">
                                    <i class="ion-ios-search"></i>
                                </div>
                                <input type="text" name="keyword" class="form-control" placeholder="Search Here!">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary btn-round" onclick="document.location='{{ url('user/create') }}'"><i class="ion-person-add"></i> Add User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
