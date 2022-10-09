@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Anggota Perpustakaan</h1>
    </div>
    <!-- Add User -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route($url, $user->id ?? '') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($user))
                    @method('put')
                @endif
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="name">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ old('name') ?? ($user->name ?? '') }}" placeholder="Nama Lengkap">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="email">Alamat Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" value="{{ old('email') ?? ($user->email ?? '') }}" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input name="gender" class="form-check-input" type="radio" id="l" value="L"
                                    @if ((old('gender') ?? ($user->gender ?? '')) == 'L') checked @endif>
                                <label class="form-check-label" for="l">Laki-Laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input name="gender" class="form-check-input" type="radio" id="p" value="P"
                                    @if ((old('gender') ?? ($user->gender ?? '')) == 'P') checked @endif>
                                <label class="form-check-label" for="p">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="col-sm-3">Password</div>
                    <div class="col-sm-9">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">Konfirmasi Password</div>
                    <div class="col-sm-9">
                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation"
                            placeholder="Ketikkan Ulang Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        @if (isset($user))
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-secondary mr-2 mt-2">Batal</a>
                        @endif
                        <button type="submit" class="btn btn-primary mt-2">{{ $button }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
