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
    <!-- END: Custom CSS-->

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
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Selamat Datang</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" for="exampleInputEmail1">Alamat Email</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Alamat Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Kata Sandi</label>
                                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Kata Sandi" name="password" required autocomplete="current-password">
                                                    </div>
                                                    <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                                        <div class="text-left">
                                                            <div class="checkbox checkbox-sm">
                                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                                <label class="checkboxsmall" for="exampleCheck1">
                                                                    <small>Ingat saya</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="text-right"><a href="javascript:;" class="card-link"><small>Lupa Kata Sandi?</small></a></div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary glow w-100 position-relative">Masuk<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                                <hr>
                                                <div class="text-center"><small class="mr-25">Tidak punya akun?</small><a href="{{ route('register') }}"><small>Registrasi</small></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <div class="card-content">
                                        <img class="img-fluid" src="{{ asset('template-default/app-assets/images/pages/login.png') }}" alt="branding logo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

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
