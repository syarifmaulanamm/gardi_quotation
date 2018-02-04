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
        <input type="text" name="type" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Capacity</label>
        <input type="number" min="1" max="10" name="capacity" class="form-control">
        <!-- <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <input id="capacity" name="capacity" type="range" min="1" max="4" step="1" value="2"/>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4" id="capacity-indicator">

            </div>
        </div> -->
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