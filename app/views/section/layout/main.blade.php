
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | PROJECT PROCUREMENT PLAN</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('public/asset/images/favicon.png') }}" type="image/x-icon">

    <link href="{{ asset('public/asset/fonts/fonts.css') }}" rel="stylesheet" type="text/css">


    <!-- Bootstrap Core Css -->
    <link href="{{ asset('public/asset/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/asset/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/asset/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <link href="{{  asset('public/asset/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('public/asset/css/themes/all-themes.css') }}" rel="stylesheet" />
    <link rel="stylesheet" media="screen" href="{{ asset('public/plugin/handson/handsontable.css') }}">

    <script src="{{ asset('public/asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugin/handson/handsontable.js') }}"></script>
    <script src="{{ asset('public/asset/js/per_section.js') }}"></script>
    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        
        function addslashes(str) {
            str=str.replace(/\\/g,'\\\\');
            str=str.replace(/\'/g,'\\\'');
            str=str.replace(/\"/g,'\\"');
            str=str.replace(/\0/g,'\\0');
            return str;
        }
    </script>
    
    <style>
        .footer {
            padding:10px;
            position: relative;
            bottom : 5;
            width: 100%;
            color: #fff;
            height: 60px;
            background-color: #2F4054;
        }
        ul {
            list-style-type: none;
        }
        
    </style>
    @section('css')

    @show
</head>
<body>
@include('section.layout.loading')
@include('section.layout.admin_nav')
@yield('content')
@include('modals.modal')
@include('section.layout.footer')
<script src="{{ asset('public/asset/plugins/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('public/asset/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<script>
    $(document).ready(function(){
        $(".preloader").hide();
         setTimeout(function () { $('.page-loader-wrapper').fadeOut(); }, 50);
    });
</script>
@if(Session::has('ops'))
    <script>
        $(document).ready(function(){
            showNotification("alert-danger", "{{ Session::get('ops') }}", "bottom", "center", null, null);
        });
    </script>
@endif
@section('js')

@show

</body>

</html>