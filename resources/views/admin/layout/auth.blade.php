<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>
{{--        @yield('title')--}}
    </title>
    <link rel="shortcut icon" href="{{ asset('/storage/assets/images/logo/favicon.ico') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
{{--    <link href="{{ asset('/storage/assets/mv/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="{{ asset('/storage/assets/mv/style.bundle.css') }}" rel="stylesheet" type="text/css"/>--}}
    @vite('resources/assets/css/app.css')
    @vite(['resources/assets/mv/plugins.bundle.css','resources/assets/mv/style.bundle.css']);

{{--    <link rel="stylesheet" href="{{ asset('/storage/assets/css/common.css') }}">--}}
{{--    @vite('resources/assets/images/logo/favicon.ico')--}}

</head>
<body id="kt_body" class="app-blank">
@yield('content')

{{--<script src="{{ asset('/storage/assets/mv/plugins.bundle.js') }}"></script>--}}
{{--<script src="{{ asset('/storage/assets/mv/scripts.bundle.js') }}"></script>--}}
<script src="{{ asset('/build/mv/plugins.bundle.js') }}"></script>
<script src="{{ asset('/build/mv/scripts.bundle.js') }}"></script>
    @vite('resources/assets/js/app.js')


{{--@vite('resources/assets/js/form-validation.js')--}}
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

@yield('script')
</body>
</html>
