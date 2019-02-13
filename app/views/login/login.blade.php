
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Favicon-->
    <title>Welcome To | PROJECT PROCUREMENT PLAN</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('public/asset/images/favicon.png') }}" type="image/x-icon">

    <link href="{{ asset('public/asset/fonts/fonts.css') }}" rel="stylesheet" type="text/css">


    <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->

    <link rel="stylesheet" href="{{ asset('public/asset/css/sb-admin.css') }}" />


</head>

<body style="background-color:#00CC99;">

<div class="container">
        
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form id="sign_in" action="{{ asset('login') }}" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                        <fieldset>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                            </div>
                                            <button class="btn btn-lg btn-success btn-block" type="submit">SIGN IN</button>
                                        </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                    <a href="{{ asset('assets') }}">Master</a>
                                    </p>
                                    <p>
                                    <a href="{{ asset('reset/password') }}">Forgot Password?</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Jquery Core Js -->
<script src="{{ asset('public/asset/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('public/asset/plugins/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('public/asset/js/sb-admin.js') }} " />
</body>

</html>