<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META SECTION -->
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="icon" href="{{asset('admin/favicon.ico')}}" type="image/x-icon" />
  <!-- END META SECTION -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


  <!-- CSS INCLUDE -->
  <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/bootstrap/bootstrap1.min.css')}}">
  <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/theme.css')}}" />
  <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/mystyle.css')}}" />

  <!-- EOF CSS INCLUDE -->
  @yield('add-css')
</head>

<body>


  <!-- PAGE CONTAINER-->
  <div class="page-container page-navigation-top">

    <!-- PAGE CONTENT -->
    <div class="page-content">

      @include('layouts.includes._navbartop')

      @yield('content')

    </div>
    <!-- END PAGE CONTENT -->
  </div>

  <!-- MESSAGE BOX-->
  <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
      <div class="mb-middle">
        <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
        <div class="mb-content">
          <p>Are you sure you want to log out?</p>
          <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
        </div>
        <div class="mb-footer">
          <div class="pull-right">
            <a href="{{ route('login') }}" class="btn btn-success btn-lg" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Iya') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
            <button class="btn btn-default btn-lg mb-control-close">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END MESSAGE BOX-->


  <!-- START SCRIPTS -->
  <!-- START PLUGINS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha512-Ua/7Woz9L5O0cwB/aYexmgoaD7lw3dWe9FvXejVdgqu71gRog3oJgjSWQR55fwWx+WKuk8cl7UwA1RS6QCadFA==" crossorigin="anonymous"></script>

  <script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery-ui.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap.min.js')}}"></script>
  <!-- END PLUGINS -->

  <!-- START THIS PAGE PLUGINS-->
  <script type='text/javascript' src="{{asset('admin/js/plugins/icheck/icheck.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>

  <!-- END THIS PAGE PLUGINS-->

  <!-- START TEMPLATE -->
  <script type="text/javascript" src="{{asset('admin/js/settings.js')}}"></script>

  <script type="text/javascript" src="{{asset('admin/js/plugins.js')}}"></script>
  <script type="text/javascript" src="{{asset('admin/js/actions.js')}}"></script>

  <!-- <script type="text/javascript" src="{{asset('admin/js/demo_dashboard.js')}}"></script> -->
  <!-- END TEMPLATE -->

  <!-- START POPPER.JS -->
  <!-- <script type="text/javascript" src="https://unpkg.com/@popperjs/core@2"></script> -->
  <!-- END POPPER.JS -->
  <!-- END SCRIPTS -->
</body>

</html>