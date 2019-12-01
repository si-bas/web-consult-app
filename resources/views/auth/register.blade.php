<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="DevPanda">
    
    <title>{{ env('APP_NAME', 'Application') }}</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/themes/semi-dark-layout.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/assets/css/style.css') }}">

    <style>
        .main-menu .navbar-header .navbar-brand .brand-logo {
            background: url("../../app-assets/images/logo/frest-logo.png") no-repeat;
            background-position: -65px -54px;
            height: 27px;
            width: 35px;
            float: left;
            margin-top: 0.2rem;
            margin-left: 3px;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Registrasi</h4>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p> <small> Silahkan lengkapi data diri dan menjadi bagian dari Mojokerto DUPAK</small>
                                            </p>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form method="POST">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6 mb-50">
                                                            <label for="inputfirstname4">Nama Depan</label>
                                                            <input type="text" class="form-control" id="inputfirstname4" placeholder="Nama Depan">
                                                        </div>
                                                        <div class="form-group col-md-6 mb-50">
                                                            <label for="inputlastname4">Nama Belakang</label>
                                                            <input type="text" class="form-control" id="inputlastname4" placeholder="Nama Belakang">
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" for="exampleInputEmail1">Alamat Email</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Alamat Email">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Kata Sandi</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Kata Sandi">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary glow position-relative w-100">Daftar<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                                <hr>
                                                <div class="text-center"><small class="mr-25">Sudah memiliki akun?</small><a href="{{ route('login') }}"><small>Masuk</small> </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- image section right -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <img class="img-fluid" src="{{ asset('template-default/app-assets/images/pages/register.png') }}" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- register section endss -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <script>
        var APP_URL = "{{ url('/') }}";
    </script>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('template-default/app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('template-default/app-assets/js/scripts/configs/vertical-menu-dark.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/scripts/footer.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>