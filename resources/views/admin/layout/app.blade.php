<!DOCTYPE html>
<html lang="en">
<head>
        <title>{{ $title?(ucwords($title).' | '.config('app.name')):config('app.name') }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

        <link rel="shortcut icon" href="{{ asset('/storage/assets/images/logo/favicon.ico') }}"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>


    @vite('resources/assets/css/app.css');
    @vite(['resources/assets/mv/plugins.bundle.css','resources/assets/mv/style.bundle.css']);

    @vite('resources/assets/css/datatables.bundle.css');

    {{--sweet alert js--}}
    {{--    <script href="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>--}}
    @vite('resources/assets/js/app.js');

{{--    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>--}}
    @vite('resources/assets/css/daterangepicker.css')
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}

    {{--    @yield('style')--}}

</head>
<body id="kt_app_body" data-kt-app-page-loading-enabled="true" data-kt-app-page-loading="on"
      data-kt-app-header-fixed="true"
      data-kt-sticky-app-header-minimize="off"
      data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true"
      data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true"
      data-kt-app-header-minimize="on"
      data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" class="app-default">
@vite('resources/assets/js/theme-mode.js');

@include('partials._page-loader')
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page  flex-column flex-column-fluid" id="kt_app_page">
        @include('partials._header')
        <div class="app-wrapper  flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('partials.sidebar.main')
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <div class="d-flex flex-column flex-column-fluid">
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        <div id="kt_app_content_container" class="app-container container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
                @include('partials._footer')
            </div>
        </div>
    </div>
</div>
@include('partials._scrolltop')
{{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}

{{-- jQuery is get inside common.js--}}

<form action="" id="way_to_grave" method="post" style="display: inline-block;">@method('DELETE')@csrf</form>

{{--@vite('resources/assets/js/jquery.validate.min.js');--}}

<script src="{{ asset('/build/mv/plugins.bundle.js') }}"></script>
<script src="{{ asset('/build/mv/scripts.bundle.js') }}"></script>
<script src="{{ asset('/build/mv/datatables.bundle.js') }}"></script>

@vite('resources/assets/js/app.js')

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>

{{--@vite(['resources/assets/js/jquery.validate.min.js'])--}}
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>--}}
@yield('script')

</body>
</html>
