<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{asset('admin/favicon.ico')}}" type="image/x-icon" />
        <!-- END META SECTION -->



        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/theme-blue.css')}}"/>
        <!-- EOF CSS INCLUDE -->

        @yield('css-add')
    </head>
    <body>


      <!-- PAGE CONTAINER-->
      <div class="page-container page-navigation-top">

        <!-- PAGE CONTENT -->
        <div class="page-content">

          @include('layouts.includes._navbar_top')

            @yield('content')

        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

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
        <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap1.min.js')}}"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type='text/javascript' src="{{asset('admin/js/plugins/icheck/icheck.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/scrolltotop/scrolltopcontrol.js')}}"></script>

        <script type="text/javascript" src="{{asset('admin/js/plugins/morris/raphael-min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/morris/morris.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/rickshaw/d3.v3.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/rickshaw/rickshaw.min.js')}}"></script>
        <script type='text/javascript' src="{{asset('admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script type='text/javascript' src="{{asset('admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script type='text/javascript' src="{{asset('admin/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/owl/owl.carousel.min.js')}}"></script>

        <script type="text/javascript" src="{{asset('admin/js/plugins/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/fullcalendar/fullcalendar.min.js')}}" defer></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/datatables/jquery.dataTables.min.js')}}" defer></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-file-input.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/summernote/summernote.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/fileinput/fileinput.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/dropzone/dropzone.min.js')}}"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>

        <!-- updated by nafilah -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script scr="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
        </script>

        
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- end updated by nafilah -->



        <script>
            $('.summernote').summernote({
                placeholder: 'Ketik Pertanyaan Disini',
                tabsize: 2,
                height: 150
            });

            $('.summernote_pil').summernote({
                placeholder: 'Ketik Pilihan Jawaban Disini',
                tabsize: 2,
                height: 80
            });
        </script>
        
    <script type="text/javascript" src="{{asset('admin/js/plugins/fileinput/fileinput.min.js')}}"></script>
        <!-- END THIS PAGE PLUGINS-->

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{asset('admin/js/settings.js')}}"></script>

        <script type="text/javascript" src="{{asset('admin/js/plugins.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/actions.js')}}"></script>

        <!-- <script type="text/javascript" src="{{asset('admin/js/demo_dashboard.js')}}"></script> -->
        @yield('data-scripts')
        @stack('scriptsToDoList')
        @yield('scripts-chrat-peminjaman')


        <script>
            $(function(){
                $("#file-simple").fileinput({
                        showUpload: false,
                        showCaption: false,
                        browseClass: "btn btn-danger",
                        fileType: "any"
                });
            });


        </script>

        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>