<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>

    <!-- Ion Icons -->
    <link href="{{ asset('bower_components\Ionicons\css\ionicons.min.css') }}" rel="stylesheet"/>
    
    <!-- App.css -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />
    
    <!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
    
    <!-- Rating -->
    <link href="{{ asset('bower_components\bootstrap-star-rating\css\star-rating.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bower_components\bootstrap-star-rating\themes\krajee-uni\theme.min.css') }}" rel="stylesheet" />

    <!-- SweetAlert -->
    <link href="{{ asset('bower_components\bootstrap-sweetalert\dist\sweetalert.css') }}" rel="stylesheet" />

    <!-- Bootstrap Select -->
    <link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="{{ asset('assets/img/sidebar-5.jpg') }}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{ url('') }}" class="simple-text">
                    <i class="ion-cube"></i> GARDI QUOTATION
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{ url('home') }}">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('quotation') }}">
                        <i class="pe-7s-calculator"></i>
                        <p>Quotation</p>
                    </a>
                </li>
                @if(Session::get('login_data')['level'] == 1)
                <li>
                    <a href="{{ url('hotel') }}">
                        <i class="pe-7s-culture"></i>
                        <p>Hotel</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('visa') }}">
                        <i class="pe-7s-credit"></i>
                        <p>Visa</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admission-ticket') }}">
                        <i class="pe-7s-ticket"></i>
                        <p>Admission Ticket</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('exchange-rate') }}">
                        <i class="pe-7s-cash"></i>
                        <p>Exchange Rate</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('settings') }}">
                        <i class="pe-7s-edit"></i>
                        <p>Settings</p>
                    </a>
                </li>
                @endif
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href='{{ isset($url_back) ? $url_back : url()->previous() }}'><i class="ion-chevron-left"></i></a>
                    <a class="navbar-brand" href="#">{{ ucwords($title) }}</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ion-person"></i> {{ Session::get('login_data')['fullname'] }}
                            </a>
                            <ul class="dropdown-menu">
                            <li><a href="#">Notification 1</a></li>
                            <li><a href="#">Notification 2</a></li>
                            <li><a href="#">Notification 3</a></li>
                            <li><a href="#">Notification 4</a></li>
                            <li><a href="#">Another notification</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('logout') }}">
                                <p><i class="ion-log-out"></i> Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://garditour.co.id">Gardi Tour</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{ asset('assets/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>

    <!-- Bootstrap Select -->
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>

    <!-- Rating -->
    <script src="{{ asset('bower_components\bootstrap-star-rating\js\star-rating.min.js') }}"></script>
    <script src="{{ asset('bower_components\bootstrap-star-rating\themes\krajee-svg\theme.min.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{ asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>
    <script src="https://use.fontawesome.com/3e4a71a224.js"></script>

    <!-- SweetAlert -->
    <script src="{{ asset('bower_components\bootstrap-sweetalert\dist\sweetalert.min.js') }}"></script>

    <!-- Number -->
    <script src="{{ asset('assets/js/jquery.number.min.js') }}"></script>
    
	<script type="text/javascript">
    	$(document).ready(function(){

        	$('.modal').appendTo("body");

            $(".osgrid-trigger").click(function(){
                $(this).parent().find('.osgrid-popover').fadeIn('slow');
            });

            $('.osgrid-popover').click(function(){
                $(this).fadeOut('slow');
            });

            $(".rating").rating();

            $( "body" ).on( "keyup", ".currency", function( event ) {
			
                // When the arrow keys are pressed, abort.
                if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                    return;
                }
			
                var $this = $( this );
			
                // Get the value.
                var input = $this.val();
			
                var input = input.replace(/[\D\s\._\-]+/g, "");
					input = input ? parseInt( input, 10 ) : 0;

					$this.val( function() {
						return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
					} );
            }); 
    	});
	</script>
    @yield('js')
</html>