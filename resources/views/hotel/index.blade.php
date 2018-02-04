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
                        <button class="btn btn-primary btn-round" onclick="document.location='{{ url('hotel/create') }}'"><i class="ion-plus"></i> Add Hotel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
<div class="content table-responsive table-full-width">
    <table class="table table-hover table-striped">
        <thead>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Stars</th>
            <th>Address</th>
            <th class="text-center" width="200">Action</th>
        </thead>
        <tbody>
        <?php $no = ($hotel->currentpage() - 1) * $hotel->perpage() + 1; ?>
        @foreach($hotel as $item)
            <tr>
                <td>{{ $no }}</td>
                <td></td>
                <td>{{ $item->name }}</td>
                <td>
                    @for($i = 0; $i < $item->stars; $i++)
                    <i class="ion-star"></i>
                    @endfor
                    <small class="text-muted">({{ $item->stars }} Stars)</small>
                </td>
                <td>{{ $item->address }}</td>
                <td class="text-center">
                    <a href="{{ url("hotel/manage/$item->id") }}" class="btn btn-success btn-sm btn-fill"><i class="ion-gear-a"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $hotel->links() }}
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

        $(".btn-delete").click(function(e){
            e.preventDefault();
            var token = '{{csrf_token()}}';
            var id = $(this).data('id');

            swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: '{{ url('hotel/bed-type') }}/'+id,
                    data: { _method: 'delete', _token : token },
                    type: 'post',
                    success: function(data){
                        if(data.success == true){
                            swal("Deleted!", "Your data has been deleted.", "success");
                            location.reload();
                        }
                    }
                });
            });
        });
    });
</script>
@endsection