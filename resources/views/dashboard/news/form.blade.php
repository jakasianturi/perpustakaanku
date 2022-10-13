@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berita</h1>
    </div>
    <!-- News -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route($url, $news->id ?? '') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($news))
                    @method('put')
                @endif
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="title">Judul Halaman</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            id="title" value="{{ old('title') ?? ($news->title ?? '') }}" placeholder="Judul Halaman">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Thumbnail</label>
                    <div class="col-sm-4">
                        <img id="image-preview"
                            src="{{ isset($news->thumbnail) ? asset('storage/uploads/' . $news->thumbnail) : '' }}"
                            class="d-block img-thumbnail rounded p-0 border-0 my-2" width="200">
                        <div class="custom-file position-relative  @error('thumbnail') is-invalid @enderror">
                            <input type="file" class="custom-file-input file position-absolute" name="thumbnail"
                                id="thumbnail" value="{{ old('thumbnail') ?? ($news->thumbnail ?? '') }}">
                            <div class="input-group position-absolute" style="z-index: 999;">
                                <input type="text" class="form-control" disabled placeholder="Unggah File"
                                    id="file">
                                <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">Pilih</button>
                                </div>
                            </div>
                        </div>
                        @error('thumbnail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="user_id">Penulis</label>
                    <div class="col-sm-9">
                        <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror"
                            style="width: 100%;">
                            @if (old('user_id') || isset($news->user_id))
                                @foreach ($users as $user)
                                    <option @if ((old('user_id') ?? ($news->user_id ?? '')) == $user->id) selected @endif value="{{ $user->id }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="content">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea id="news_content" class="form-control @error('content') is-invalid @enderror" name="content"
                            placeholder="Isi informasi disini">{{ old('ncontent') ?? ($news->content ?? '') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        @if (isset($news))
                            <a href="{{ route('dashboard.news.index') }}" class="btn btn-secondary mr-2 mt-2">Batal</a>
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
        // News Thumbnail
        document.querySelector(".browse").addEventListener("click", triggerInput);

        function triggerInput() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        };
        document.getElementById("thumbnail").addEventListener("change", changeFileName);

        function changeFileName(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);
        };
        document.getElementById("thumbnail").addEventListener("change", imagePreview);

        function imagePreview() {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('image-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Author Search
        $('#user_id').select2({
            placeholder: 'Cari penulis...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('dashboard.news.loadDataAdmin') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // laravel-filemanager with Summernote
        $(document).ready(function() {
            // Define function to open filemanager window
            var lfm = function(options, cb) {
                var route_prefix = '{{ url('/') }}/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                    'width=900,height=600');
                window.SetUrl = cb;
            };
            // Define LFM summernote button
            var LFMButton = function(context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'Masukkan Gambar',
                    click: function() {
                        lfm({
                            type: 'image',
                            prefix: '/laravel-filemanager'
                        }, function(lfmItems, path) {
                            lfmItems.forEach(function(lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        });

                    }
                });
                return button.render();
            };
            // Initialize summernote with LFM button in the popover button group
            // Please note that you can add this button to any other button group you'd like
            $('#news_content').summernote({
                height: 400,
                maxHeight: 400,
                lang: 'id-ID',
                buttons: {
                    lfm: LFMButton
                },
                toolbar: [
                    ['popovers', ['lfm']],
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
            })
        });
    </script>
@endsection
