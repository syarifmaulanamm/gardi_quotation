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
    <div class="content table-responsive table-full-width">
        <table class="table table-hover table-striped">
            <thead>
                <th>Item</th>
                <th>Description</th>
                <!-- <th>Currency</th> -->
                <th>Price</th>
                <th>Qty</th>
                <th>Dur</th>
                <th>Amount</th>
                <th class="text-center" width="170">Action</th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" colspan="7">
                        <a href="{{ url('quotation/'.$quotation->id.'/variablecost/create') }}" class="btn btn-round btn-primary"><i class="ion-plus"></i> Add Variable Cost</a>
                    </td>
                </tr>
                @foreach($variableCost as $item)
                <tr>
                    <td><strong>{{ $item->item }}</strong></td>
                    <td>{{ $item->remarks }}</td>
                    <!-- <td>{{ $item->cur->code }}</td> -->
                    <td>{{ number_format($item->price, 0, ',', ',') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->duration }}</td>
                    <td>{{ number_format($item->amount, 0, ',', ',') }}</td>
                    <td class="text-center">
                        <button class="btn btn-success btn-fill btn-sm" onclick="document.location='{{ url("quotation/variablecost/update/$item->id") }}'"><i class="ion-edit"></i> Edit</button>  
                        <button class="btn btn-danger btn-fill btn-sm btn-delete" data-id="{{ $item->id }}"><i class="ion-trash-b"></i> Delete</button> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
                    url: '{{ url('quotation/variablecost') }}/'+id,
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