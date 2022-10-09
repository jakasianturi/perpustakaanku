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

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/select2-bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body>
    <!-- Header -->
    <header class="section-header bg-white">
        <!-- Header-main -->
        <section id="header-main" class="header-main border-bottom d-none d-md-block">
            <div class="container">
                <div class="row align-items-center justify-content-md-between">
                    <div class="col-lg-3 col-md-3 col-12">
                        <a href="{{ url('/') }}" class="brand-wrap">
                            <img class="mw-100 logo"
                                src="{{ isset($setting->logo) ? asset('storage/uploads/' . $setting->logo) : '' }}"
                                style="width: 200px; height: 60px;object-fit:contain;"
                                alt="{{ isset($setting->site_name) ? $setting->site_name : '' }}">
                        </a>
                        <!--. brand-wrap -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-8 col-12">
                        <form action="{{ route('searchBook') }}" class="search mx-lg-auto">
                            <div class="input-group w-100">
                                <input type="text" id="query_search" name="query_search"
                                    value="{{ $request['query_search'] ?? '' }}" class="form-control"
                                    placeholder="Cari buku..." />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        Cari<i class="fa fa-search ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!--. search-wrap -->
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12 text-md-right">
                        <div class="mt-3 mt-md-0 d-flex justify-content-end">
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="btn btn-outline-primary rounded-pill btn-hovered font-weight-bold px-4"
                                                href="{{ route('login') }}">{{ __('Masuk') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item"
                                                href="@if (Auth::user()->user_role == 'admin') {{ route('dashboard.dashboard') }} @elseif(Auth::user()->user_role == 'member') {{ route('member.member') }} @else {{ url('/') }} @endif">
                                                Dashboard
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                Keluar
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                    <!--. col -->
                </div>
                <!--. row -->
            </div>
            <!--. container -->
        </section>
        <!--. End Header-main -->
        <!-- Fixed-nav -->
        <section id="fixed-nav">
            <nav id="main-nav" class="position-relative navbar navbar-expand-md bg-white navbar-light shadow-sm">
                <div class="container">
                    <a href="{{ url('/') }}" class="brand-wrap d-md-none">
                        <img class="logo"
                            src="{{ isset($setting->logo) ? asset('storage/uploads/' . $setting->logo) : '' }}" />
                    </a>
                    <!--. brand-wrap -->
                    <!-- Search -->
                    <div class="nav-item ml-auto d-md-none">
                        <a class="nav-link text-dark" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <div class="search-nav dropdown-menu dropdown-menu-right p-3 shadow"
                            aria-labelledby="searchDropdown">
                            <div class="container d-flex justify-content-end">
                                <form action="{{ route('searchBook') }}" class="w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" id="query_searchMobile" name="query_search"
                                            value="{{ $request['query_search'] ?? '' }}"
                                            class="form-control bg-light border-1 small" placeholder="Cari buku..."
                                            aria-label="Search" aria-describedby="Search" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <button id="menuToggle" class="navbar-toggler border-0" type="button" data-toggle="collapse"
                        data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarMain">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">Beranda <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item {{ request()->is('books') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('books') }}">Daftar Koleksi Buku</a>
                            </li>
                            <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                                <a class="nav-link " href="{{ route('about') }}">Tentang
                                    kami</a>
                            </li>
                            <li class="nav-item d-md-none d-flex">
                                <ul class="navbar-nav mx-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="btn btn-outline-primary rounded-pill btn-hovered font-weight-bold px-4"
                                                    href="{{ route('login') }}">Masuk</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                {{ Auth::user()->name }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item"
                                                    href="@if (Auth::user()->user_role == 'admin') {{ route('dashboard.dashboard') }} @elseif(Auth::user()->user_role == 'member') {{ route('member.member') }} @else {{ url('/') }} @endif">
                                                    Dashboard
                                                </a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-formMobile').submit();">
                                                    Keluar
                                                </a>

                                                <form id="logout-formMobile" action="{{ route('logout') }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </section>
        <!--. End Fixed-nav -->
    </header>
    <!--. End Header -->
    @yield('content')

    <!-- Footer -->
    <footer id="footer" class="bg-light border-top mt-5 py-5">
        <div class="container">
            <div class="d-flex justify-content-start">
                <a href="{{ url('/') }}" class="text-decoration-none mb-3">
                    <img src="{{ isset($setting->logo) ? asset('storage/uploads/' . $setting->logo) : '' }}"
                        alt="{{ isset($setting->site_name) ? $setting->site_name : '' }}"
                        style="max-width: 100%; height: 100px;object-fit:contain;" />
                </a>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-4 col-md-6 mb-xs-4 mb-lg-auto">
                    <ul class="list-unstyled">
                        <li class="mb-1 d-flex">
                            <i class="fa fa-map-marker-alt iconFooterList mr-2 text-dark"></i>
                            <address class="text-dark text-decoration-none mb-0">
                                {{ isset($setting->address) ? $setting->address : '' }}</address>
                        </li>
                        <li class="mb-1 d-flex">
                            <i class="fa fa-phone-alt iconFooterList mr-2 text-dark"></i><a
                                href="tel:{{ isset($setting->phone) ? $setting->phone : '' }}"
                                class="text-dark text-decoration-none">{{ isset($setting->phone) ? $setting->phone : '' }}</a>
                        </li>
                        <li class="mb-1 d-flex">
                            <i class="fa fa-envelope iconFooterList mr-2 text-dark"></i><a
                                href="mailto:{{ isset($setting->email) ? $setting->email : '' }}"
                                class="text-dark text-decoration-none">{{ isset($setting->email) ? $setting->email : '' }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-xs-4 mb-lg-auto">
                    <h5 class="text-dark">Halaman</h5>
                    <ul class="list-unstyled">
                        <li class="mb-1">
                            <a href="{{ route('about') }}" class="text-dark text-decoration-none">Tentang
                                Perpustakaanku</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-auto col-md-6 mb-xs-4 mb-lg-auto">
                    <h5 class="text-dark">Jam Operasional Layanan Perpustakaan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-1">
                            <p class="text-dark">
                                {{ isset($setting->operational_time) ? $setting->operational_time : '' }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 my-4">
                <div class="text-center">
                    <a href="{{ isset($setting->social_facebook) ? $setting->social_facebook : '' }}"><i
                            class="fab fa-facebook-f socialIconFooter"></i></a>
                    <a class=" mx-3"
                        href="{{ isset($setting->social_instagram) ? $setting->social_instagram : '' }}"><i
                            class="fab fa-instagram socialIconFooter"></i></a>
                    <a href="{{ isset($setting->social_twitter) ? $setting->social_twitter : '' }}"><i
                            class="fab fa-twitter socialIconFooter"></i></a>
                </div>
            </div>
            <div class="col-12">
                <div class="text-center">
                    <span>{!! $setting->site_footer ?? '' !!}</span>
                </div>
            </div>
        </div>
    </footer>
    <!--Custom Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/i18n/id.js') }}"></script>

    @yield('customStyle')
</body>

</html>
