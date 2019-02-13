<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>PPMP</title>
    <!-- Favicon-->

    <link rel="icon" href="{{ asset('public/asset/images/favicon.png') }}" type="image/x-icon">

    <link href="{{ asset('public/asset/fonts/fonts.css') }}" rel="stylesheet" type="text/css">


    <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('public/asset/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('public/asset/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{ asset('public/asset/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/asset/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{  asset('public/asset/css/style.css') }}" rel="stylesheet">
</head>

<body>
<div class="container-fluid">
    <table class="table">
        <form action="{{ asset('arrange/pppcode') }}" method="POST">
            <thead>
                <tr>
                        <th>Expense Codes | <a href="{{ asset('assets/menu')}}"><em>Master</em></a> | <a href="{{ asset('arrange/pppcode') }}">Arange Order</a></th>
                        <th></th>
                        <th>Placement Order</th>
                        <th>Enter Arrangement Order</th>
                    </tr>
            </thead>
            <tbody>
                @foreach($uacs as $uac)
                    <tr>
                        <td><h5>{{ $uac->expense_name }}</h5></td>
                        <td>
                            <a href="{{ asset('edit/uacs?ppcode='. $uac->id) }}" class="btn btn-primary">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                            <a href="{{ asset('delete/uacs/'. $uac->id) }}" class="btn btn-danger">
                                <i class="glyphicon glyphicon-trash"></i> Delete
                            </a>
                        </td>
                        <td>{{ $uac->order_by }}</td>
                        <td><input type="text" class="form-control" name="order[{{ $uac->id }}]" value="{{ $uac->order_by }}" /></td>
                    </tr>
                    
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input type="submit" name="submit" class="btn btn-success btn-lg" value="Arrange" /></td>
                </tr>
            </tbody>
        </form>
    </table>
</div>
<!-- Jquery Core Js -->
<script src="{{ asset('public/asset/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('public/asset/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('public/asset/plugins/node-waves/waves.js') }}"></script>

<!-- Validation Plugin Js -->
<script src="{{ asset('public/asset/plugins/jquery-validation/jquery.validate.js') }}"></script>

<script src="{{ asset('public/asset/js/pages/examples/sign-in.js') }}"></script>
<script src="{{ asset('public/asset/js/demo.js') }}"></script>

<script src="{{ asset('public/asset/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('public/asset/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
<script src="{{ asset('public/asset/js/pages/ui/notifications.js') }}"></script>
</body>

</html>