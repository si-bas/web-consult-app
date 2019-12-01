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
            <li class="{{ Request::is('home', 'dashboard') ? 'active' : '' }} nav-item">
                <a href="{{ route('home') }}">
                    <i class="menu-livicon" data-icon="desktop"></i>
                    <span class="menu-title" data-i18n="">Dashboard</span>
                </a>
            </li>

            <li class="navigation-header">
                <span>Menu</span>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="unlock"></i>
                    <span class="menu-title" data-i18n="">Verifikasi</span>
                </a>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="grid"></i>
                    <span class="menu-title" data-i18n="">Konsultasi</span>
                </a>
            </li>

            <li class="navigation-header">
                <span>Pengguna</span>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="users"></i>
                    <span class="menu-title" data-i18n="">Dosen</span>
                </a>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="users"></i>
                    <span class="menu-title" data-i18n="">Mahasiswa</span>
                </a>
            </li>

            <li class=" nav-item">
                <a href="#">
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
                    <li>
                        <a href="#"><i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Provinsi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Kabupaten/Kota</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Kecamatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            <span class="menu-item" data-i18n="">Kelurahan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="building"></i>
                    <span class="menu-title" data-i18n="">Fakultas</span>
                </a>
            </li>

            <li class=" nav-item">
                <a href="#">
                    <i class="menu-livicon" data-icon="briefcase"></i>
                    <span class="menu-title" data-i18n="">Jurusan</span>
                </a>
            </li>

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
        </ul>
    </div>
</div>