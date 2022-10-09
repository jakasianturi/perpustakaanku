<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($setting->site_name) ? $setting->site_name : '' }}</title>

    <!-- Google Meta -->
    <meta name="description" content="{{ isset($setting->meta_description) ? $setting->meta_description : '' }}" />
    <meta name="description" content="{{ isset($setting->meta_keyword) ? $setting->meta_keyword : '' }}" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <link rel="canonical" href="{{ url('/') }}" />

    <!-- Favicon -->
    <link rel="icon" href="{{ isset($setting->favicon) ? asset('storage/uploads/' . $setting->favicon) : '' }}">

    <!-- Google Analytics -->
    {{ isset($setting->ga_code) ? $setting->ga_code : '' }}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/select2-bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('dashboard.dashboard') }}">
                <img class="mw-100" src="{{ isset($setting->logo) ? asset('storage/uploads/' . $setting->logo) : '' }}"
                    style="width: 200px; height: 60px; object-fit:contain;"
                    alt="{{ isset($setting->site_name) ? $setting->site_name : '' }}">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Buku
            </div>

            <!-- Nav Item - Kategori -->
            <li
                class="nav-item {{ request()->is('dashboard/categories') || request()->is('dashboard/categories/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.categories.index') }}">
                    <i class="fas fa-swatchbook fa-fw"></i>
                    <span>Kategori Buku</span></a>
            </li>

            <!-- Nav Item - Rak Buku -->
            <li
                class="nav-item {{ request()->is('dashboard/bookshelves') || request()->is('dashboard/bookshelves/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.bookshelves.index') }}">
                    <i class="fas fa-box fa-fw"></i>
                    <span>Rak Buku</span></a>
            </li>

            <!-- Nav Item - Buku -->
            <li
                class="nav-item {{ request()->is('dashboard/books') || request()->is('dashboard/books/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.books.index') }}">
                    <i class="fas fa-book fa-fw"></i>
                    <span>Buku</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Transaksi
            </div>

            <!-- Nav Item - Peminjaman Buku -->
            <li
                class="nav-item {{ request()->is('dashboard/borrows') || request()->is('dashboard/borrows/*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->is('dashboard/borrows') || request()->is('dashboard/borrows/*') ? '' : 'collapsed' }}"
                    href="#" data-toggle="collapse" data-target="#collapseBorrows" aria-expanded="true"
                    aria-controls="collapseBorrows">
                    <i class="fas fa-book-medical fa-fw text-white-50"></i>
                    <span>Peminjaman Buku</span>
                </a>
                <div id="collapseBorrows"
                    class="collapse {{ request()->is('dashboard/borrows') || request()->is('dashboard/borrows/*') ? 'show' : '' }}"
                    aria-labelledby="headingBorrows" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('dashboard/borrows') ? 'active' : '' }}"
                            href="{{ route('dashboard.borrows.index') }}">Peminjaman Baru</a>
                        <a class="collapse-item {{ request()->is('dashboard/borrows/create') ? 'active' : '' }}"
                            href="{{ route('dashboard.borrows.create') }}">Tambah Peminjaman</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pengembalian Buku -->
            <li
                class="nav-item {{ request()->is('dashboard/returneds') || request()->is('dashboard/returneds/*') ? 'active' : '' }}">
                <a class="nav-link {{ request()->is('dashboard/returneds') || request()->is('dashboard/returneds/*') ? '' : 'collapsed' }}"
                    href="#" data-toggle="collapse" data-target="#collapseReturned" aria-expanded="true"
                    aria-controls="collapseReturned">
                    <i class="fas fa-book-open fa-fw text-white-50"></i>
                    <span>Pengembalian Buku</span>
                </a>
                <div id="collapseReturned"
                    class="collapse {{ request()->is('dashboard/returneds') || request()->is('dashboard/returneds/*') ? 'show' : '' }}"
                    aria-labelledby="headingReturned" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('dashboard/returneds') ? 'active' : '' }}"
                            href="{{ route('dashboard.returneds.index') }}">Daftar
                            Peminjaman</a>
                        <a class="collapse-item {{ request()->is('dashboard/returneds/nonactive') ? 'active' : '' }}"
                            href="{{ route('dashboard.returneds.nonactive') }}">Pengembalian Selesai</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Anggota Perpustakaan -->
            <li
                class="nav-item {{ request()->is('dashboard/users') || request()->is('dashboard/users/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.users.index') }}">
                    <i class="fas fa-users fa-fw"></i>
                    <span>Anggota Perpustakaan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Informasi
            </div>

            <!-- Nav Item - Berita -->
            <li
                class="nav-item {{ request()->is('dashboard/news') || request()->is('dashboard/news/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.news.index') }}">
                    <i class="fas fa-newspaper fa-fw"></i>
                    <span>Berita</span></a>
            </li>

            <!-- Nav Item - Pengaturan Situs -->
            <li class="nav-item {{ request()->is('dashboard/settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.settings.index') }}">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Pengaturan Situs</span></a>
            </li>

            <!-- Nav Item - Banner -->
            <li
                class="nav-item {{ request()->is('dashboard/banners') || request()->is('dashboard/banners/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.banners.index') }}">
                    <i class="fas fa-images fa-fw"></i>
                    <span>Banner</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Profil
            </div>
            <!-- Nav Item - Profile -->
            <li
                class="nav-item {{ request()->is('dashboard/profiles') || request()->is('dashboard/profiles/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.profiles.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Kembali Ke Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ isset(Auth::user()->avatar) ? asset('storage/uploads/' . Auth::user()->avatar) : asset('img/undraw_male_avatar_323b.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard.profiles.index') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>{!! $setting->site_footer ?? '' !!}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Silahkan pilih "Keluar" jika Anda yakin ingin keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Keluar') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Custom Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- All Script from Vendor -->
    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('vendor/summernote/lang/summernote-id-ID.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/iziToast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/i18n/id.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

    <!-- SB Admin 2 -->
    <script src="{{ asset('vendor/sb-admin-2/js/sb-admin-2.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    @yield('customStyle')
</body>

</html>
