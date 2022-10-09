@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Banner</h1>
    </div>
    <!-- Banners -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route($url, $banner->id ?? '') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($banner))
                    @method('put')
                @endif
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="title">Judul Banner</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            id="title" value="{{ old('title') ?? ($banner->title ?? '') }}" placeholder="Judul Banner">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Background</label>
                    <div class="col-sm-4">
                        <img id="image-preview"
                            src="{{ isset($banner->background) ? asset('storage/uploads/' . $banner->background) : '' }}"
                            class="d-block img-thumbnail rounded p-0 border-0 my-2" width="200">
                        <div class="custom-file position-relative  @error('background') is-invalid @enderror">
                            <input type="file" class="custom-file-input file position-absolute" name="background"
                                id="background" value="{{ old('background') ?? ($banner->background ?? '') }}">
                            <div class="input-group position-absolute" style="z-index: 999;">
                                <input type="text" class="form-control" disabled placeholder="Unggah File"
                                    id="file">
                                <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">Pilih</button>
                                </div>
                            </div>
                        </div>
                        @error('background')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="description">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                            rows="5" placeholder="Isi deskripsi disini">{{ old('description') ?? ($banner->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="button_text">Teks Button</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror"
                            name="button_text" id="button_text"
                            value="{{ old('button_text') ?? ($banner->button_text ?? '') }}" placeholder="Teks Button">
                        @error('button_text')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="button_url">URL Button</label>
                    <div class="col-sm-9">
                        <input type="url" class="form-control @error('button_url') is-invalid @enderror"
                            name="button_url" id="button_url"
                            value="{{ old('button_url') ?? ($banner->button_url ?? '') }}" placeholder="URL Button">
                        @error('button_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        @if (isset($banner))
                            <a href="{{ route('dashboard.banners.index') }}" class="btn btn-secondary mr-2 mt-2">Batal</a>
                        @endif
                        <button type="submit" class="btn btn-primary mt-2">{{ $button }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('customStyle')
    <style>
        .file {
            visibility: hidden;
            position: absolute;
        }
    </style>
    <script>
        // Banner Background
        document.querySelector(".browse").addEventListener("click", triggerInput);

        function triggerInput() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        };
        document.getElementById("background").addEventListener("change", changeFileName);

        function changeFileName(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);
        };
        document.getElementById("background").addEventListener("change", imagePreview);

        function imagePreview() {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('image-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
