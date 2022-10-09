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
                                <img class="bg-auth" src="{{ asset('img/undraw_forgot_password_re_hxwm.svg') }}"
                                    alt="Image">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Kata Sandi?</h1>
                                    </div>
                                    <form method="POST" action="{{ route('password.update') }}" class="user">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group">
                                            <input id="email" type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                name="email" value="{{ $email ?? old('email') }}" required
                                                autocomplete="email" autofocus placeholder="Masukkan alamat email...">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input id="password" type="password"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password"
                                                    placeholder="Kata sandi">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <input id="password-confirm" type="password"
                                                    class="form-control form-control-user" name="password_confirmation"
                                                    required autocomplete="new-password"
                                                    placeholder="Ketik ulang kata sandi">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Reset Kata Sandi') }}
                                        </button>
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
