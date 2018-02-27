@extends('themes.default')

@section('title', $title)

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger alert-dismissable text-center">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
{{ Session::get('errors') }}
</div>
@endif
<form action="{{ url('quotation/landarrangement/update/'.$la->id.'?mode=manual') }}" method="post">
{{ csrf_field() }}
    <div class="form-group">
        <label>Item</label>
        <select name="item" class="form-control">
            <option value="Land Arrangement" selected>Land Arrangement</option>
        </select>
    </div>
    <div class="form-group">
        <label>Description</label>
        <input type="text" name="remarks" value="{{ $la->remarks }}" class="form-control" placeholder="LA Name">
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="text" name="price" class="form-control currency" value="{{ number_format($la->price, 0, ',', ',') }}" id="price">
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <input type="number" min="1" name="quantity" class="form-control" value="{{ $la->quantity }}" id="qty">
    </div>
    <div class="form-group">
        <label>Duration</label>
        <input type="number" min="1" name="duration" class="form-control" value="{{ $la->duration }}" id="dur">
    </div>
    <div class="form-group">
        <label>Amount</label>
        <input type="text" name="amount" readonly class="form-control currency" value="{{ number_format($la->amount, 0, ',', ',') }}" id="amount">
    </div>
    <button type="submit" class="btn btn-primary">Save changes</button>
</form>
@endsection

@section('js')
<script>
    $(document).ready(function(){
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