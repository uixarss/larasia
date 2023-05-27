<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- META SECTION -->
        <title>Login {{ config('app.name', 'Laravel') }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="{{asset('admin/favicon.ico')}}" type="image/x-icon" />
        <!-- END META SECTION -->



        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('admin/css/theme-white.css')}}"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>

      @yield('content')

    </body>
</html>
