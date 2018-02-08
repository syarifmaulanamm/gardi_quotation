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
        <label>Item</label>
        <select name="item" class="form-control">
            <option value="la" selected>Land Arrangement</option>
        </select>
    </div>
    <div class="form-group">
        <label>Description</label>
        <input type="text" name="remarks" class="form-control" placeholder="LA Name">
    </div>
    <div class="form-group" id="remarks">
        <label></label>
        <input type="text" name="remarks" class="form-control">
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