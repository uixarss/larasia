<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('adtheme/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adtheme/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="app-blank" style="background-color: #013880;">
    @yield('content')
    <script src="{{ asset('adtheme/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('adtheme/js/scripts.bundle.js') }}"></script>
</body>

</html>
