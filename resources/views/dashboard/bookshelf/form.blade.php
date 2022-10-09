@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rak Buku</h1>
    </div>
    <!-- Add Bookshelf -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route($url, $bookshelf->id ?? '') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($bookshelf))
                    @method('put')
                @endif
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="bookshelf_name">Nama Rak Buku</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('bookshelf_name') is-invalid @enderror"
                            name="bookshelf_name" id="bookshelf_name"
                            value="{{ old('bookshelf_name') ?? ($bookshelf->bookshelf_name ?? '') }}"
                            placeholder="Nama Rak Buku">
                        @error('bookshelf_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        @if (isset($bookshelf))
                            <a href="{{ route('dashboard.bookshelves.index') }}"
                                class="btn btn-secondary mr-2 mt-2">Batal</a>
                        @endif
                        <button type="submit" class="btn btn-primary mt-2">{{ $button }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
