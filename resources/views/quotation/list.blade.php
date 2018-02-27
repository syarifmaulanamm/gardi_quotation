@extends('themes.default')

@section('title', $title)

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <div class="pull-left">
                    <h4 class="title">My Quotations</h4>
                    <p class="category">Perhitungan Paket Tour & Umrah</p>
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary btn-round" data-step="1" data-intro="Klik untuk mulai membuat quotation!" style="margin-top:10px" onclick="document.location='{{ url('quotation/create') }}'"><i class="ion-plus"></i> Create Quotation</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="content">
                <div class="footer">
                    <hr>
                    <div class="legend">
                        <i class="fa fa-circle text-success"></i> Approved
                        <i class="fa fa-circle text-warning"></i> Pending
                        <i class="fa fa-circle text-danger"></i> Expired
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
@foreach($quotations as $item)
    <div class="col-md-4">
        <div class="card" data-step="2" data-intro="Quotation yang sudah dibuat">
            <div class="header">
                <h4 class="title" title="{{ $item->tour_name }}"><i class="fa fa-circle text-success"></i> {{ substr($item->tour_name, 0, 23) }}{{ strlen($item->tour_name) > 23 ? '...' : '' }}</h4>
                <div class="category">
                    <span>
                        <i class="ion-pricetag"></i> {{ $item->cat->name }}
                    </span>
                    <span>
                        <i class="ion-cash"></i> {{ $item->cur->code }}
                    </span>
                    <span>
                        <i class="ion-person"></i> {{ $item->author->fullname }}
                    </span>
                </div>
            </div>
            <div class="content">
                <div class="footer">
                    <hr>
                    <div class="category">
                        <small><i class="ion-clock"></i> Validity {{ date('d M Y', strtotime($item->validity)) }}</small>
                    </div>
                    <div class="pull-right">
                        <ul class="card-option">
                            <li class="dropdown">
                                <a class="btn-cog dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-step="3" data-intro="Klik untuk membuka opsi!">
                                    <i class="ion-gear-b"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#download" data-id="{{ $item->id }}"><i class="ion-ios-download"></i> Download</a></li>
                                    <li><a href="{{ url('quotation/basket/'.$item->id) }}"><i class="ion-edit"></i> Edit</a></li>
                                    <li><a href="#" data-id="{{ $item->id }}" class="btnDelete"><i class="ion-trash-b"></i> Delete</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>

{{ $quotations->links() }}


<!-- Modal -->
<div id="download" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-body">
            <p class="text-center">Download Quotation</p>
            <a href="#" class="btn btn-block btn-primary btn-round" target="_blank" id="btn-download-pdf"><i class="fa fa-file-pdf"></i> PDF (.pdf)</a>
            <a href="#" class="btn btn-block btn-primary btn-round disabled" target="_blank" id="btn-download-xls"><i class="fa fa-file-excel"></i> Excel (.xls)</a>
        </div>
        <div class="modal-footer text-center">
            <button type="button" class="btn btn-block close" data-dismiss="modal">&times;</button>
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

    $("a[data-target='#download']").click(function(){
        var id = $(this).data('id');

        introJs().exit();
        $("#btn-download-pdf").attr('href', '{{ url('quotation/download') }}/' + id + '/pdf' );
        $("#btn-download-xls").attr('href', '{{ url('quotation/download') }}/' + id + '/xls' );
    });

    $(".btnDelete").click(function(e){
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
                  url: '{{ url('quotation') }}/'+id,
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
