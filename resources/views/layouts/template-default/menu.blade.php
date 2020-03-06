<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">Konsultasi</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
        @if (!Request::is('profile/student/complete', 'questionnaire/fill/*', 'information/consent/form', 'content/required/*', 'quiz/required/*'))
            @role(['admin'])
            <li class="{{ Request::is('home', 'dashboard') ? 'active' : '' }} nav-item">
                <a href="{{ route('home') }}">
                    <i class="menu-livicon" data-icon="desktop"></i>
                    <span class="menu-title" data-i18n="">Dashboard</span>
                    <span class="badge badge-light-primary badge-pill badge-round float-right">Dev</span>
                </a>
            </li>
            @endrole

            <li class="navigation-header">
                <span>Menu</span>
            </li>

            {{-- <li class=" nav-item">
                <a href="{{ route('user.student.list') }}">
                    <i class="menu-livicon" data-icon="unlock"></i>
                    <span class="menu-title" data-i18n="">Verifikasi</span>
                </a>
            </li> --}}

            @role('admin')            
            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="notebook"></i>
                    <span class="menu-title" data-i18n="">Kuesioner</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::is('questionnaire/list', 'questionnaire/detail', 'questionnaire/question/*') ? 'active' : '' }}"">
                        <a href="{{ route('questionnaire.list') }}"><i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Daftar Kuesioner</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('questionnaire/respondent/*') ? 'active' : '' }}">
                        <a href="{{ route('questionnaire.respondent.list') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Daftar Responden</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            @endrole

            @role(['lecturer', 'student'])
            <li class="{{ Request::is('profile/student/detail') ? 'active' : '' }} nav-item">
                <a href="
                @role('student')
                    {{ route('profile.student.detail') }}
                @endrole
                ">
                    <i class="menu-livicon" data-icon="user"></i>
                    <span class="menu-title" data-i18n="">Profil</span>
                </a>
            </li>
            @endrole

            @role('lecturer')
            <li class="{{ Request::is('schedule/availability/*') ? 'active' : '' }} nav-item">
                <a href="{{ route('schedule.availability.list') }}">
                    <i class="menu-livicon" data-icon="calendar"></i>
                    <span class="menu-title" data-i18n="">Jadwal Tersedia</span>
                </a>
            </li>
            @endrole

            <li class="{{ Request::is('consult/student/*', 'consult/lecturer/*') ? 'active' : '' }} nav-item">
                <a href="
                    @role('student')
                        {{ route('consult.student.list') }}
                    @endrole
                    @role('lecturer')
                        {{ route('consult.lecturer.list') }}
                    @endrole
                ">
                    <i class="menu-livicon" data-icon="grid"></i>
                    <span class="menu-title" data-i18n="">Konsultasi</span>
                </a>
            </li>

            @role('admin')
            <li class="navigation-header">
                <span>Pengguna</span>
            </li>

            <li class="{{ Request::is('user/lecturer/*') ? 'active' : '' }} nav-item">
                <a href="{{ route('user.lecturer.list') }}">
                    <i class="menu-livicon" data-icon="users"></i>
                    <span class="menu-title" data-i18n="">Dosen</span>
                </a>
            </li>

            <li class="{{ Request::is('user/student/*') ? 'active' : '' }} nav-item">
                <a href="{{ route('user.student.list') }}">
                    <i class="menu-livicon" data-icon="users"></i>
                    <span class="menu-title" data-i18n="">Mahasiswa</span>
                    <span class="" id="student-count"></span>
                </a>
            </li>

            <li class="{{ Request::is('user/administrator/*') ? 'active' : '' }} nav-item">
                <a href="{{ route('user.administrator.list') }}">
                    <i class="menu-livicon" data-icon="users"></i>
                    <span class="menu-title" data-i18n="">Administrator</span>
                </a>
            </li>

            <li class="navigation-header">
                <span>Referensi Data</span>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="morph-map"></i>
                    <span class="menu-title" data-i18n="">Wilayah</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::is('area/province/*') ? 'active' : '' }}">
                        <a href="{{ route('area.province.list') }}"><i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Provinsi</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('area/district/*') ? 'active' : '' }}">
                        <a href="{{ route('area.district.list') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Kabupaten/Kota</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('area/subdistrict/*') ? 'active' : '' }}">
                        <a href="{{ route('area.subdistrict.list') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Kecamatan</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('area/village/*') ? 'active' : '' }}">
                        <a href="{{ route('area.village.list') }}">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Kelurahan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('university/faculty/*') ? 'active' : '' }} nav-item">
                <a href="{{ route('university.faculty.list') }}">
                    <i class="menu-livicon" data-icon="building"></i>
                    <span class="menu-title" data-i18n="">Fakultas</span>
                </a>
            </li>

            <li class="{{ Request::is('university/major/*') ? 'active' : '' }} nav-item">
                <a href="{{ route('university.major.list') }}">
                    <i class="menu-livicon" data-icon="briefcase"></i>
                    <span class="menu-title" data-i18n="">Jurusan</span>
                </a>
            </li>
            @endrole
            <li class="navigation-header">
                <span>Lainnya</span>
            </li>

            <li class=" nav-item">
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    <i class="menu-livicon" data-icon="close"></i>
                    <span class="menu-title" data-i18n="">Keluar</span>
                </a>
            </li>

            {{-- <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="morph-menu-arrow-bottom"></i>
                    <span class="menu-title" data-i18n="">Menu Levels</span>
                </a>
                <ul class="menu-content">
                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Second Level</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Second Level</span>
                        </a>
                        <ul class="menu-content">
                            <li>
                                <a href="#"><i class="bx bx-right-arrow-alt"></i>
                                    <span class="menu-item" data-i18n="">Third Level</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="bx bx-right-arrow-alt"></i>
                                    <span class="menu-item" data-i18n="">Third Level</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
        @else 
        <li class="active nav-item">
            <a href="javascript:;">
                <i class="menu-livicon" data-icon="notebook"></i>
                <span class="menu-title" data-i18n="">
                    @if (Request::is('information/consent/form'))
                        Informasi Penelitian
                    @elseif(Request::is('content/required/show/video'))
                        Konten Video
                    @elseif(Request::is('quiz/required/*'))
                        Kuis
                    @else
                        Kuesioner
                    @endif
                </span>
                <span class="" id="student-count"></span>
            </a>
        </li>

        <li class=" nav-item">
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <i class="menu-livicon" data-icon="close"></i>
                <span class="menu-title" data-i18n="">Keluar</span>
            </a>
        </li>
        @endif
        </ul>
    </div>
</div>

@role('admin')
    @push('scripts')
        <script>
            const getStudentBadge = () => {
                let el = $("#student-count");
                $.get("{{ route('notification.badge.user.unverified.count') }}").done(function (result) {
                    el.attr('class', result.class);
                    el.html(result.count);
                });
            }

            $(document).ajaxStart(function () {
                getStudentBadge();
            });
        </script>
    @endpush
@endrole