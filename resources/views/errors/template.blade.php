<!DOCTYPE html>
<html lang="en">

<head>
    <!-- META SECTION -->
    <title>Joli Admin - Responsive Bootstrap Admin Template</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/theme-blue.css')}}" />
    <!-- EOF CSS INCLUDE -->
</head>

<body>
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <div class="error-container">
                    <div class="error-code">@yield('code')</div>
                    <div class="error-text">@yield('message')</div>
                    <div class="error-subtext">Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below.</div>
                    <div class="error-actions">
                        <div class="row">
                            @can('manage-users')
                            <a href="{{ route('admin.halamanutama.index') }}" class="btn btn-info btn-block btn-lg">Back to dashboard</a>
                            @endcan
                            @can('view-guru')
                            <a href="{{ route('guru.halamanutama.index') }}" class="btn btn-info btn-block btn-lg">Back to dashboard</a>
                            @endcan
                            @can('view-siswa')
                            <a href="{{ route('siswa.halamanutama.index') }}" class="btn btn-info btn-block btn-lg">Back to dashboard</a>
                            @endcan
                            @can('view-pegawai')
                            <a href="{{ route('pegawai.halamanutama.index') }}" class="btn btn-info btn-block btn-lg">Back to dashboard</a>
                            @endcan
                            <button class="btn btn-primary btn-block btn-lg" onClick="history.back();">Previous page</button>

                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</body>


<!-- START PLUGINS -->
<script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/jquery/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/plugins/bootstrap/bootstrap.min.js')}}"></script>
<!-- END PLUGINS -->

</html>