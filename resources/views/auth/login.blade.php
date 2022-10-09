@extends('layouts.auth')
@section('content')
    <div class="container" style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-3">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img class="bg-auth" src="{{ asset('img/undraw_secure_login_pdn4.svg') }}" alt="Image">
                            </div>
                            <div class=" col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang Kembali!</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf

                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email') }}" required
                                                autocomplete="email" autofocus aria-describedby="emailHelp"
                                                placeholder="Masukkan alamat email..." />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Kata sandi" />
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary btn-user btn-block">{{ __(' Masuk ') }}</button>
                                        <hr />
                                        @if (Route::has('password.request'))
                                            <div class="text-center">
                                                <a class="small text-decoration-none"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Lupa Kata Sandi?') }}
                                                </a>
                                            </div>
                                        @endif
                                        <div class="text-center mt-2">
                                            <p>Belum punya akun? Silahkan <a class="text-decoration-none"
                                                    href="{{ route('register') }}">
                                                    {{ __('Registrasi') }}
                                                </a>
                                            </p>
                                        </div>
                                        <div class="text-center mt-2">
                                            <p>Kembali ke <a class="text-decoration-none" href="{{ route('home') }}">
                                                    {{ __('Beranda') }}
                                                </a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
