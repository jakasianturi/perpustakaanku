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
                                        <h1 class="h4 text-gray-900 mb-4">Verifikasi Alamat email Anda!</h1>
                                    </div>
                                    @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                                        </div>
                                    @endif
                                    {{ __('Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi.') }}
                                    {{ __('Jika Anda tidak menerima email') }},
                                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-link p-0 m-0 align-baseline">{{ __('Klik di sini untuk meminta yang lain') }}</button>.
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
