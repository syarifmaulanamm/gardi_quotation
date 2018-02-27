@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif
<form action="{{ url('quotation/'.$quotation->id.'/landarrangement/create?mode=manual') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label>Item</label>
        <select name="item" class="form-control">
            @foreach($items as $item)
            <option value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <!-- <div class="form-group" id="hotel">
        <label>Hotel</label>
        <div class="input-group">
            <input type="text" class="form-control" name="remarks">
            <span class="input-group-btn">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#searchHotel" title="Search Hotel"><i class="ion-search"></i></button>
            </span>
        </div>
    </div> -->
    <div class="form-group">
        <label>Description</label>
        <input type="text" name="remarks" class="form-control" placeholder="Ex: Hotel Name">
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="text" name="price" class="form-control currency" id="price">
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <input type="number" min="1" name="quantity" value="1" class="form-control" id="qty">
    </div>
    <div class="form-group">
        <label>Duration</label>
        <input type="number" min="1" name="duration" value="1" class="form-control" id="dur">
    </div>
    <div class="form-group">
        <label>Amount</label>
        <input type="text" name="amount" readonly class="form-control currency" id="amount">
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>

<!-- Search Hotel -->
<div class="modal fade" id="searchHotel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <i class="ion-search"></i> Search Hotel
                <button type="button" class="close" data-dismiss="modal">&times;</button>            
            </div>
            <div class="modal-body">
                <div class="input-group search-form">
                    <div class="input-group-addon">
                        <i class="ion-ios-search"></i>
                    </div>
                    <input type="text" id="search" class="form-control" placeholder="Search Here!" autofocus>
                </div>
                <table class="table table-hover table-striped">
                    <tbody>
                    @foreach($hotels as $item)
                    <tr>
                        <td class="text-center" colspan="7" style="background-color:#0984e3; color: white;">
                            <h4>
                                {{ $item->name }}
                                @for($i = 0; $i < $item->stars; $i++)
                                <i class="ion-star"></i>
                                @endfor
                            </h4>
                            <small>{{ $item->address }}</small>
                        </td>
                    </tr>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Capacity</th>
                            <th>Price</th>
                            <th>Validity</th>
                            <th>Remarks</th>
                            <th class="text-center" width="200">Action</th>
                        </tr>
                        @foreach($item->rooms as $r)
                        <tr>
                            <td width="100"><img src="{{ asset('storage/images/hotel/'.$r->images[0]) }}" alt="{{ $item->name }}" width="100px"></td>
                            <td>{{ ucwords( $r->name ) }}</td>
                            <td>
                                    <span style="font-size:18pt">
                                    @for($i = 0; $i < $r->capacity; $i++)
                                    <i class="ion-person"></i>
                                    @endfor
                                    </span>
                            </td>
                            <td>
                                    <strong>{{ $r->cur->code }} {{ number_format($r->price, 0, ',', ',') }}</strong>
                            </td>
                            <td>{{ date('d-m-Y', strtotime($r->validity)) }}</td>
                            <td>{{ $r->remarks }}</td>
                            <td class="text-center">							
                            </td>
						</tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $("#remarks").hide();
        $('#price').on('keyup', function(){
            getAmount();
        });
        $('#qty').on('keyup', function(){
            getAmount();
        });
        $('#dur').on('keyup', function(){
            getAmount();
        });

        function getAmount(){
            var price = $('#price').val().split(',').join('');
            var dur = $('#dur').val();
            var qty = $('#qty').val();
            var amount = price * dur * qty;

            $('#amount').val( $.number( amount ) );
        }
    });
</script>
@endsection