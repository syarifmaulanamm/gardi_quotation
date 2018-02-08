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
            @foreach($items as $item)
            <option value="{{ $item->name }}" @if($vc->item == $item->name) selected @endif>{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Description</label>
        <input type="text" name="remarks" class="form-control" value="{{ $vc->remarks }}">
    </div>
    <div class="form-group">
        <label>Price</label>
        <input type="text" name="price" class="form-control currency" value="{{ number_format($vc->price, 0, ',', ',') }}" id="price">
    </div>
    <div class="form-group">
        <label>Quantity</label>
        <input type="number" min="1" name="quantity" class="form-control" value="{{ $vc->quantity }}" id="qty">
    </div>
    <div class="form-group">
        <label>Duration</label>
        <input type="number" min="1" name="duration" class="form-control" value="{{ $vc->duration }}" id="dur">
    </div>
    <div class="form-group">
        <label>Amount</label>
        <input type="text" name="amount" readonly class="form-control currency" value="{{ number_format($vc->amount, 0, ',', ',') }}" id="amount">
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