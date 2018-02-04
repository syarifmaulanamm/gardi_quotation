@extends('themes.default')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="widget-title">
                            <i class="ion-person"></i> Contact
                        </div>
                        <p><i class="ion-email"></i> {{ $hotel->email }}</p>
                        <p><i class="ion-ios-telephone"></i> {{ $hotel->phone }}</p>
                        <br>
                        <div class="widget-title">
                            <i class="ion-stats-bars"></i> Features
                        </div>
                        @foreach($hotel->feature as $item)
                        <i class="ion-checkmark-circled" style="color:#2962ff"></i> {{ $item }}<br>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <div class="widget-title">
                            <i class="ion-location"></i> Address
                        </div>
                        <iframe width="100%" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBc9bb3nIOn1jS7oOQc2mDU1t0iBdDcDb8&q={{ urlencode($hotel->name)}}" allowfullscreen>
                        </iframe>
                    </div>
                    <div class="col-md-4">
                        <div class="widget-title">
                            <i class="ion-images"></i> Images 
														<!-- Admin Access -->														
                            <a href="{{ url('hotel/manage/'.$hotel->id.'/images') }}" class="btn btn-default btn-round btn-xs"><i class="ion-plus"></i> Add Images</a>
														<!-- Admin Access -->                        
												</div>
                        @if($hotel->images == null)
                        <img src="http://via.placeholder.com/300x300/55efc4/00b894?text={{ $hotel->name }}">
                        @else
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            @for($i = 1; $i <= count($hotel->images); $i++)
                            <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
                            @endFor
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                            <img src="http://via.placeholder.com/300x300/55efc4/00b894?text={{ $hotel->name }}">
                            </div>
                            @foreach($hotel->images as $item)
                            <div class="item">
                            <img src="{{ asset('storage/images/hotel/'.$item) }}" alt="{{ $item }}">
                            </div>
                            @endforeach
                        </div>
                        </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
<br><br>
<div class="row">
    <div class="col-md-6">
        <h2 style="margin-top:0px;"><i class="ion-bookmark"></i> Hotel Rooms</h2>
    </div>
    <div class="col-md-6 text-right">
				<!-- Admin Access -->		
        <a href="{{ url('hotel/manage/'.$hotel->id.'/room/create') }}" class="btn btn-primary btn-round"><i class="ion-plus"></i> Add Room</a>        
				<!-- Admin Access -->    
		</div>
</div>
</div>

<div class="card">
<div class="content table-responsive table-full-width">
<?php $no = ($rooms->currentpage() - 1) * $rooms->perpage() + 1; ?>
    <table class="table table-hover table-striped">
        <thead>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <!-- <th>Room Type</th>
            <th>Bed Type</th> -->
            <th>Capacity</th>
						<th>Price</th>
						<th>Validity</th>
            <th>Remarks</th>
            <th class="text-center" width="200">Action</th>
        </thead>
        <tbody>
            @foreach($rooms as $item)
            <tr>
                <td>{{ $no++ }}</td>
								<td width="200"><img src="{{ asset('storage/images/hotel/'.$item->images[0]) }}" alt="{{ $item->name }}" width="200px"></td>
								<td>{{ ucwords( $item->name ) }}</td>
								<!-- <td>{{ ucwords( $item->roomType->type ) }}</td>
								<td>{{ ucwords( $item->bedType->type ) }}</td> -->
								<td>
										<span style="font-size:18pt">
										@for($i = 0; $i < $item->capacity; $i++)
										<i class="ion-person"></i>
										@endfor
										</span>
								</td>
								<td>
										<strong>{{ $item->cur->code }} {{ number_format($item->price, 0, ',', ',') }}</strong>
								</td>
								<td>{{ date('d-m-Y', strtotime($item->validity)) }}</td>
								<td>{{ $item->remarks }}</td>
								<td width="70" class="text-center">
									<!-- Admin Access -->
									<button class="btn btn-success btn-fill btn-sm" onclick="document.location='{{ url("hotel/room/update/$item->id") }}'"><i class="ion-edit"></i> Edit</button>  
									<button class="btn btn-danger btn-fill btn-sm btn-delete" data-id="{{ $item->id }}"><i class="ion-trash-b"></i> Delete</button>  
									<!-- Admin Access -->								
								</td>
						</tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $rooms->links() }}    
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
                    url: '{{ url('hotel/room') }}/'+id,
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