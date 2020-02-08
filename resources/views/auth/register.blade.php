<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="DevPanda">
    
    <title>{{ config('app.name') }}</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template-default/app-assets/vendors/css/forms/select/select2.min.css') }}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mobile-auth.css') }}">
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
                                            <p>
                                                <small>Aplikasi menjamin kerahasian data Anda</small>
                                            </p>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form method="POST" accept="{{ route('register.submit') }}" id="registration">
                                                    @csrf
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">Nama Lengkap </label>
                                                        <input type="text" class="form-control" placeholder="Nama Depan" name="full_name" value="{{ old('full_name') }}">
                                                    </div>

                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">NIM</label>
                                                        <input type="text" class="form-control" placeholder="Nomor Induk Mahasiswa" name="student_id_number" value="{{ old('student_id_number') }}">
                                                    </div>

                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">Alamat Email</label>
                                                        <small class="text-muted">(tidak wajib)</small>
                                                        <input type="email" class="form-control" placeholder="Alamat Email" name="email" value="{{ old('email') }}">
                                                    </div>

                                                    <div class="form-group mb-2">
                                                        <label class="text-bold-600">Kata Sandi</label>
                                                        <small class="text-muted">(tidak wajib)</small>
                                                        <input type="password" class="form-control" placeholder="Kata Sandi" name="password">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary glow position-relative w-100">Daftar<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                                <hr>
                                                <div class="text-center"><small class="mr-25">Sudah memiliki akun?</small>
                                                    <a href="{{ route('login') }}" class="btn btn-secondary glow w-100 position-relative">Masuk<i id="icon-arrow" class="bx bx-file"></i></a>
                                                </div>
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
    <script src="{{ asset('template-default/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('template-default/app-assets/js/scripts/configs/vertical-menu-dark.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('template-default/app-assets/js/scripts/footer.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('js/helper.js') }}"></script>
    <script>
        const select_faculty = $('select[name=faculty_id]');
        const select_major = $('select[name=major_id]');

        const form_registration = $('#registration');

        $(function () {
            select_faculty.select2({
                placeholder: 'Pilih Fakultas',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('register.get.faculties') }}",
                    dataType: 'json',
                    type: "GET",
                    quietMillis: 50,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });

            select_major.select2({
                placeholder: 'Pilih Program Studi',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('register.get.majors') }}",
                    dataType: 'json',
                    type: "GET",
                    quietMillis: 50,
                    data: function(params) {
                        return {
                            search: params.term,
                            id: select_faculty.val()
                        }
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });

            form_registration.submit(e => {
                e.preventDefault();

                let form_data = form_registration.serializeArray().reduce((obj, item) => {
                    obj[item.name] = item.value;
                    return obj;
                }, {});

                $.post(form_registration.attr('action'), form_data).done(result => {
                    let card_body = form_registration.parent();
                    
                    removeAlert(card_body);

                    if (result.status == 'error') {
                        showAlert('danger', 'bx-error', result.message, card_body);
                    } else {
                        window.location = `{{ route('register.done') }}?data=${result.data.code}`;
                    }
                });
            });
        });
    </script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>