<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PPMP</title>
    <link href="{{ asset('public/asset/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/asset/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/asset/css/sb-admin.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/asset/css/style.css') }}" rel="stylesheet" />
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('public/asset/css/themes/all-themes.css') }}" rel="stylesheet" />
    <link rel="stylesheet" media="screen" href="{{ asset('public/plugin/handson/handsontable.css') }}">

    <script src="{{ asset('public/asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugin/handson/handsontable.js') }}"></script>
    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
    <!-- Bootstrap Core CSS -->
    <style>
        body{
            font-family: arial,sans-serif;
        }
        a { cursor: pointer; }
        .htCore thead tr th{
            color: white;
            font-weight: bold;
            font-size: 17px;
            font-family: arial,sans-serif;
            background-color: #2ECC71;
        }
        .htCore tbody tr td{
            font-weight: bold;
            font-size: 15px;
            font-family: arial,sans-serif;
        }
    </style>
</head>
<body style="background-color:white;">
<div id="wrapper">
    @include('section.layout.nav_header')
    @yield('content')
</div>
@include('modals.modal')
<script src="{{ asset('public/asset/plugins/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('public/asset/js/script.js') }}"></script>
<script src="{{ asset('public/asset/js/page.js') }}"></script>
@section('js')

@show

</body>
</html>
