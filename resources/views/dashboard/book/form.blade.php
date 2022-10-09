@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buku</h1>
    </div>
    <!-- Add Book -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route($url, $book->id ?? '') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($book))
                    @method('put')
                @endif
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="category_id">Nama Kategori</label>
                    <div class="col-sm-9">
                        <select id="category_id" name="category_id"
                            class="form-control @error('category_id') is-invalid @enderror" style="width: 100%;">
                            @if (old('category_id') || isset($book->category_id))
                                @foreach ($categories as $category)
                                    <option @if ((old('category_id') ?? ($book->category_id ?? '')) == $category->id) selected @endif value="{{ $category->id }}">
                                        {{ $category->category_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="bookshelf_id">Rak Buku</label>
                    <div class="col-sm-9">
                        <select id="searchBookshelf" name="bookshelf_id"
                            class="form-control @error('bookshelf_id') is-invalid @enderror" style="width: 100%;">
                            @if (old('bookshelf_id') || isset($book->bookshelf_id))
                                @foreach ($bookshelves as $bookshelf)
                                    <option @if ((old('bookshelf_id') ?? ($book->bookshelf_id ?? '')) == $bookshelf->id) selected @endif value="{{ $bookshelf->id }}">
                                        {{ $bookshelf->bookshelf_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('bookshelf_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="book_id">ID Buku</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('book_id') is-invalid @enderror" name="book_id"
                            id="book_id" value="{{ old('book_id') ?? ($book->book_id ?? '') }}" placeholder="ID Buku">
                        @error('book_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="title">Judul Buku</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            id="title" value="{{ old('title') ?? ($book->title ?? '') }}" placeholder="Judul Buku">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="author">Penulis</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('author') is-invalid @enderror" name="author"
                            id="author" value="{{ old('author') ?? ($book->author ?? '') }}" placeholder="Penulis">
                        @error('author')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="publisher">Penerbit</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher"
                            id="publisher" value="{{ old('publisher') ?? ($book->publisher ?? '') }}"
                            placeholder="Penerbit">
                        @error('publisher')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="publication">Tahun Terbit</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control @error('publication') is-invalid @enderror"
                            name="publication" id="publication"
                            value="{{ old('publication') ?? ($book->publication ?? '') }}" placeholder="Tahun Terbit">
                        @error('publication')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="isbn">ISBN</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn"
                            id="isbn" value="{{ old('isbn') ?? ($book->isbn ?? '') }}" placeholder="ISBN">
                        @error('isbn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="stock">Stok Buku</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                            min="0" id="stock" value="{{ old('stock') ?? ($book->stock ?? '') }}"
                            placeholder="Stok Buku">
                        @error('stock')
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
                            placeholder="Deskripsi Buku">{{ old('description') ?? ($book->description ?? '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sampul Buku</label>
                    <div class="col-sm-4">
                        <img id="image-preview"
                            src="{{ isset($book->cover) ? asset('storage/uploads/' . $book->cover) : '' }}"
                            class="d-block img-thumbnail rounded p-0 border-0 my-2" width="250">
                        <div class="custom-file position-relative @error('cover') is-invalid @enderror">
                            <input type="file" class="custom-file-input file position-absolute" name="cover"
                                id="cover" value="{{ old('cover') ?? ($book->cover ?? '') }}">
                            <div class="input-group position-absolute" style="z-index: 999;">
                                <input type="text" class="form-control" disabled placeholder="Unggah File"
                                    id="file">
                                <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">Pilih</button>
                                </div>
                            </div>
                        </div>
                        @error('cover')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        @if (isset($book))
                            <a href="{{ route('dashboard.books.index') }}" class="btn btn-secondary mr-2 mt-2">Batal</a>
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
        // Book Cover
        document.querySelector(".browse").addEventListener("click", triggerInput);

        function triggerInput() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        };
        document.getElementById("cover").addEventListener("change", changeFileName);

        function changeFileName(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);
        };
        document.getElementById("cover").addEventListener("change", imagePreview);

        function imagePreview() {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('image-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // Category Search
        $('#category_id').select2({
            placeholder: 'Cari kategori...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('dashboard.books.getDataCategory') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.category_name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // Bookshelf Search
        $('#searchBookshelf').select2({
            placeholder: 'Cari rak buku...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('dashboard.books.getDataBookshelf') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.bookshelf_name,
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
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
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
            $('#description').summernote({
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
