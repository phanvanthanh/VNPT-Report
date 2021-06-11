<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ứng dụng Tiếp nhận - Giao việc nhanh</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/template/default/assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('public/template/default/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('public/template/default/assets/js/modernizr.min.js') }}" rel="stylesheet" type="text/css">



    </head>


    <body class="bg-accpunt-pages">

        @yield('content')



        <!-- jQuery  -->
        <script src="{{ asset('public/template/default/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/waves.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('public/template/plugins/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('public/template/plugins/counterup/jquery.counterup.min.js') }}"></script>
        <!-- Chart JS -->
        <script src="{{ asset('public/template/plugins/chart.js/chart.bundle.js') }}"></script>
        <!-- init dashboard -->
        <script src="{{ asset('public/template/default/assets/pages/jquery.dashboard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('public/template/default/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('public/template/default/assets/js/jquery.app.js') }}"></script>




    </body>
</html>