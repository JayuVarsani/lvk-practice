<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>
        @yield('title')
    </title>
    <link rel="shortcut icon" href="{{ asset('/storage/assets/images/logo/favicon.ico') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="{{ asset('/storage/assets/mv/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/storage/assets/mv/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/storage/assets/css/common.css') }}">
    @vite('resources/js/app.js')
</head>
<body id="kt_body" class="app-blank">
@yield('content')

<script src="{{ asset('/storage/assets/mv/plugins.bundle.js') }}"></script>
<script src="{{ asset('/storage/assets/mv/scripts.bundle.js') }}"></script>

@yield('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
</body>
</html>
