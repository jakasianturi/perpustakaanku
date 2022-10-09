@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kategori Buku</h1>
    </div>
    <!-- Add Category -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route($url, $category->id ?? '') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($category))
                    @method('put')
                @endif
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="category_name">Nama Kategori</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                            name="category_name" id="category_name"
                            value="{{ old('category_name') ?? ($category->category_name ?? '') }}"
                            placeholder="Nama Kategori">
                        @error('category_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        @if (isset($category))
                            <a href="{{ route('dashboard.categories.index') }}"
                                class="btn btn-secondary mr-2 mt-2">Batal</a>
                        @endif
                        <button type="submit" class="btn btn-primary mt-2">{{ $button }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
