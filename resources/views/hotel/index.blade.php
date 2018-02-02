@extends('themes.default')

@section('title', $title)

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group search-form">
                            <div class="input-group-addon">
                                <i class="ion-ios-search"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Search Here!">
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary btn-round" onclick="document.location='{{ url('hotel/create') }}'"><i class="ion-plus"></i> Add Hotel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="osgrid osgrid-hotel">
            <div class="osgrid-image">
                <img src="http://via.placeholder.com/150x150" alt="Placeholder">
            </div>
            <div class="osgrid-content">
                <h3 class="osgrid-title">Mandarin Orchard Singapore</h3>
                <div class="osgrid-stars"><i class="ion-star"></i><i class="ion-star"></i><i class="ion-star"></i><i class="ion-star"></i><i class="ion-star"></i></div>
                <div class="osgrid-location"><a href="https://www.google.com/maps/place/Mandarin+Orchard+Singapore"><i class="ion-location"></i> 333 Orchard Road, Singapura 238867</a></div>
                <div class="osgrid-type">
                    <table width="100%">
                        <tr>
                            <td>Number of Rooms</td>
                            <td>:</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Room Type</td>
                            <td>:</td>
                            <td>Family Suite</td>
                        </tr>
                        <tr>
                            <td>Bed Type</td>
                            <td>:</td>
                            <td>Triple</td>
                        </tr>
                    </table>
                </div>
                <div class="osgrid-price">IDR 3,153,671</div>
            </div>
            <div class="osgrid-control">
                <a class="osgrid-trigger" data-id="">
                    <i class="ion-gear-b"></i>
                </a>
                <div class="osgrid-popover">
                    <div class="osgrid-popover-btn">
                        <a href="#" class="btn btn-success btn-fill"><i class="ion-edit"></i> Edit</a>
                        <a href="#" class="btn btn-danger btn-fill"><i class="ion-trash-b"></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="osgrid osgrid-hotel">
            <div class="osgrid-image">
                <img src="http://via.placeholder.com/150x150" alt="Placeholder">
            </div>
            <div class="osgrid-content">
                <h3 class="osgrid-title">Mandarin Orchard Singapore</h3>
                <div class="osgrid-stars"><i class="ion-star"></i><i class="ion-star"></i><i class="ion-star"></i><i class="ion-star"></i><i class="ion-star"></i></div>
                <div class="osgrid-location"><a href="https://www.google.com/maps/place/Mandarin+Orchard+Singapore"><i class="ion-location"></i> 333 Orchard Road, Singapura 238867</a></div>
                <div class="osgrid-type">
                    <table width="100%">
                        <tr>
                            <td>Number of Rooms</td>
                            <td>:</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Room Type</td>
                            <td>:</td>
                            <td>Family Suite</td>
                        </tr>
                        <tr>
                            <td>Bed Type</td>
                            <td>:</td>
                            <td>Triple</td>
                        </tr>
                    </table>
                </div>
                <div class="osgrid-price">IDR 3,153,671</div>
            </div>
            <div class="osgrid-control">
                <a class="osgrid-trigger" data-id="">
                    <i class="ion-gear-b"></i>
                </a>
                <div class="osgrid-popover">
                    <div class="osgrid-popover-btn">
                        <a href="#" class="btn btn-success btn-fill"><i class="ion-edit"></i> Edit</a>
                        <a href="#" class="btn btn-danger btn-fill"><i class="ion-trash-b"></i> Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
    <ul class="pagination">
    <li><a href="#">&laquo;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
    </ul>
</div>
@endsection