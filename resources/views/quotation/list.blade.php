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
                    <button class="btn btn-primary btn-round" style="margin-top:10px" onclick="document.location='{{ url('quotation/create') }}'"><i class="ion-plus"></i> Create Quotation</button>
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
        <div class="card">
            <div class="header">
                <h4 class="title"><i class="fa fa-circle text-success"></i> {{ $item->tour_name }}</h4>
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
                                <a class="btn-cog dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ion-gear-b"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('quotation/basket/'.$item->id) }}"><i class="ion-edit"></i> Edit</a></li>
                                    <li><a href="#"><i class="ion-trash-b"></i> Delete</a></li>
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
@endsection