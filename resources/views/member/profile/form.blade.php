@extends('member.layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Edit Profil</h1>
</div>

<form method="POST" action="{{ route('member.profiles.update', $user->id) }}">
  @csrf
  @method('put')
  <div class="form-group row">
    <label class="col-sm-3 col-form-label" for="name">Nama Lengkap</label>
    <div class="col-sm-9">
      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
        value="{{ old('name') ?? $user->name ?? ''}}" placeholder="Nama lengkap">
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
      <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
        value="{{ $user->email}}">
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label" for="address">Alamat</label>
    <div class="col-sm-9">
      <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address"
        rows="3">{{ old('address') ?? $user->address ?? ''}}</textarea>
      @error('address')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-3 col-form-label" for="phone">No. Telepon</label>
    <div class="col-sm-9">
      <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
        value="{{ old('phone') ?? $user->phone ?? ''}}">
      @error('phone')
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
          <input name="gender" class="form-check-input" type="radio" id="l" value="l" @if((old('gender') ??
            $user->gender ?? '') == 'L') checked @endif>
          <label class="form-check-label" for="l">Laki-Laki</label>
        </div>
        <div class="form-check form-check-inline">
          <input name="gender" class="form-check-input" type="radio" id="p" value="p" @if((old('gender') ??
            $user->gender ?? '') == 'P') checked @endif>
          <label class="form-check-label" for="p">Perempuan</label>
        </div>
      </div>
    </div>
  </fieldset>
  <h5 class="text-bold text-dark">Ubah Password?</h5>
  <div class="form-group row">
    <div class="col-sm-3">Password</div>
    <div class="col-sm-9">
      <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
        placeholder="Password">
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
      <a href="{{ route('member.profiles.index') }}" class="btn btn-secondary mr-2 mt-2">Batal</a>
      <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
    </div>
  </div>
</form>
@endsection