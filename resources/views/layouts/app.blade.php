<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <!-- Bikinan AING -->
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="{{asset('css/theme-white.css')}}" rel="stylesheet" type="text/css" id="theme" />

</head>

<body>
    <div id="app">
          @yield('partials.alerts') <!-- kalau pake include ga bisa di panggil kalau pake yeild ngga kepanggil -->
          @yield('content')
    </div>
</body>




<script type="text/javascript" src="{{asset('js/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap.min.js')}}"></script>

<!-- START THIS PAGE PLUGINS-->
<script type='text/javascript' src="{{asset('js/plugins/icheck/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}" deffer></script>
<script type="text/javascript" src="{{asset('js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>

<script type="text/javascript" src="{{asset('js/plugins/morris/raphael-min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/morris/morris.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/rickshaw/d3.v3.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/rickshaw/rickshaw.min.js')}}"></script>
<script type='text/javascript' src="{{asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script type='text/javascript' src="{{asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script type='text/javascript' src="{{asset('js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/owl/owl.carousel.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/plugins/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/plugins/daterangepicker/daterangepicker.js')}}"></script>


<script type="text/javascript" src="{{asset('/js/plugins/datatables/jquery.dataTables.min.js')}}" defer></script>

<!-- <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script> -->


<!-- END THIS PAGE PLUGINS-->

<!-- START TEMPLATE -->
<!-- <script type="text/javascript" src="{{asset('js/settings.js')}}"></script> -->
<!-- <script type="" src="{{asset('js/actions.js')}}"></script> -->
<script type="text/javascript" src="{{asset('js/plugins.js')}}" defer></script>
<!-- <script type="text/javascript" src="{{asset('js/demo_dashboard.js')}}"></script> -->
<!-- END TEMPLATE -->




</html>
