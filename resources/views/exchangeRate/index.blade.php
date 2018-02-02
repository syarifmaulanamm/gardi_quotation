@extends('themes.default')

@section('title', $title)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-md-6 col-sm-8 col-xs-12">
                            <form action="{{ url()->current() }}">
                                <div class="input-group search-form">
                                    <div class="input-group-addon">
                                        <i class="ion-ios-search"></i>
                                    </div>
                                    <input type="text" name="keyword" class="form-control" placeholder="Search Here!">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-4 col-xs-12 text-right">
                            <button class="btn btn-primary btn-round" onclick="document.location='{{ url('exchange-rate/create') }}'"><i class="ion-plus"></i> Add Exchange Rate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="content table-responsive table-full-width">
        <?php $no = ($exchangeRate->currentpage() - 1) * $exchangeRate->perpage() + 1; ?>
            <table class="table table-hover table-striped">
                <thead>
                    <th>#</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Rate</th>
                    <th>Updated</th>
                    <th class="text-center" width="200">Action</th>
                </thead>
                <tbody>
                @foreach($exchangeRate as $item)
                    <tr>
                        <td><strong>{{ $no++ }}</strong></td>
                        <td>{{ $item->from }}</td>
                        <td>{{ $item->to }}</td>
                        <td>{{ number_format($item->rate, 0, '', ',') }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td class="text-center">
                            <button class="btn btn-success btn-fill btn-sm" onclick="document.location='{{ url("exchange-rate/update/$item->id") }}'"><i class="ion-edit"></i> Edit</button>  
                            <button class="btn btn-danger btn-fill btn-sm btn-delete" data-id="{{ $item->id }}"><i class="ion-trash-b"></i> Delete</button>  
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $exchangeRate->links() }}
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
                    url: '{{ url('exchange-rate') }}/'+id,
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