<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gardi Quotation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('assets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>

    <!-- Ion Icons -->
    <link href="{{ asset('bower_components\Ionicons\css\ionicons.min.css') }}" rel="stylesheet"/>
    

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
<style>
    body {
        background: rgba(0, 177, 106, 0.5);
    }
    #login {
        background-color : white;
        padding: 20px;
        margin-top: 10%;
        box-shadow: 0px 10px 15px -10px #013243;
        border-radius: 5px;
    }
    .login-header h1 {
        font-size: 24pt;
        text-align: center;
    }
    .login-header .divider {
        width: 100px;
        height: 5px;
        background-color: #00B16A;
        margin: 20px auto;
    }
    .btn-login {
        border-color: #00B16A !important;
        color: #00B16A;
        transition: all .4s ease-in-out;
    }
    .btn-login:hover {
        border-color: transparent;
        color: white;
        background-color: #00B16A;
    }

</style>
</head>
<body>
    <div class="container animated zoomIn">
        <div class="col-md-4 col-md-offset-4" id="login">
            <div class="login-header">
                <h1><i class="ion-cube"></i> GARDI QUOTATION</h1>
                <div class="divider"></div>

                @if (Session::has('errors'))
                <div class="alert alert-danger alert-dismissable text-center">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get('errors') }}
                </div>
                @endif
            </div>    
            <div class="login-content">
                <form action="" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <button class="btn btn-login btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>