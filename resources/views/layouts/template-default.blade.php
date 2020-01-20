<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name') }}</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/ui/prism.min.css') }}">
    @stack('links')
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    @stack('page-links')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <style>
        .table {
            width: 100%; !important
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-sticky fixed-footer  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" onload="startTime()">

    <!-- BEGIN: Header-->
    @include('layouts.template-default.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('layouts.template-default.menu')
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('layouts.template-default.footer')
    <!-- END: Footer-->

    <script>
        const APP_URL = "{{ url('/') }}";
    </script>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('template-default/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>

    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('template-default/app-assets/vendors/js/ui/prism.min.js') }}"></script>
    @stack('src-scripts')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('template-default/app-assets/js/scripts/configs/vertical-menu-dark.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @stack('scripts')
    <script src="{{ asset('js/helper.js') }}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>