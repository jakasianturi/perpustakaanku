@extends('layouts.front')

@section('content')
    <!-- Book Collection -->
    <main role="main">
        <div id="collection" class="container mt-5">
            <div class="mb-5">
                <h3 class="mb-2 text-black">Semua Koleksi Buku</h3>
                <span class="divider bg-primary"></span>
            </div>
            <div class="mb-5">
                <form class="bg-light p-2 rounded" action="">
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="title">Nama Buku</label>
                            <input type="text" class="form-control" name="title" id="title"
                                value="{{ $request['title'] ?? '' }}" placeholder="Nama Buku" />
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="isbn">ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="isbn"
                                value="{{ $request['isbn'] ?? '' }}" placeholder="ISBN" />
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="category_id">Kategori</label>
                            <select id="category_id" name="category_id" class="form-control" style="width: 100%;">
                                @if (isset($request['category_id']))
                                    @foreach ($categories as $category)
                                        <option @if (($request['category_id'] ?? '') == $category->id) selected @endif
                                            value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="publication">Tahun Terbit</label>
                            <select id="publication" name="publication" class="form-control" style="width: 100%;">
                                @if (isset($request['publication']))
                                    @foreach ($allBooks as $book)
                                        <option @if (($request['publication'] ?? '') == $book->publication) selected @endif
                                            value="{{ $book->publication }}">{{ $book->publication }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="author">Penulis</label>
                            <select id="author" name="author" class="form-control" style="width: 100%;">
                                @if (isset($request['author']))
                                    @foreach ($allBooks as $book)
                                        <option @if (($request['author'] ?? '') == $book->author) selected @endif
                                            value="{{ $book->author }}">{{ $book->author }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="sr-only" for="publisher">Penerbit</label>
                            <select id="publisher" name="publisher" class="form-control" style="width: 100%;">
                                @if (isset($request['publisher']))
                                    @foreach ($allBooks as $book)
                                        <option @if (($request['publisher'] ?? '') == $book->publisher) selected @endif
                                            value="{{ $book->publisher }}">{{ $book->publisher }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari Buku</button>
                    <a href="{{ route('books') }}" class="btn btn-secondary">
                        <i class="fa fa-sync-alt iconFooterList text-light"></i>
                    </a>
                </form>
            </div>
            @if ($books->total())
                <div class="row collection-book-list">
                    @foreach ($books as $book)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-5">
                            <div class="book-list">
                                <a class="book-list__img" href="{{ route('detailBook', $book->slug ?? '') }}">
                                    <img src="{{ isset($book->cover) ? asset('storage/uploads/' . $book->cover) : '' }}" />
                                </a>
                                <div class="book-list__body">
                                    <h6 class="book-list__body--title"><a
                                            href="{{ route('detailBook', $book->slug ?? '') }}">{{ $book->title }}</a>
                                    </h6>
                                    <a class="book-list__body--category"
                                        href="{{ route('detailCategory', $book->category->slug ?? '') }}">
                                        <p>{{ $book->category->category_name ?? '' }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $books->links() }}
            @elseif(isset($request))
                <div class="alert alert-secondary" role="alert">
                    <h5>Mohon maaf, tidak ada buku seperti yang Anda cari.</h5>
                </div>
            @else
                <div class="alert alert-secondary" role="alert">
                    <h5>Mohon maaf, daftar buku belum ada.</h5>
                </div>
            @endif
        </div>
    </main>
    <!--. End Book Collection -->
@endsection
@section('customStyle')
    <script>
        // Category Search
        $('#category_id').select2({
            placeholder: 'Semua kategori...',
            allowClear: true,
            // tags: true,
            tokenSeparators: [',', ' '],
            language: "id",
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('getDataCategory') }}",
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
        // Author Search
        $('#author').select2({
            placeholder: 'Semua penulis...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('getDataAuthor') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.author,
                                id: item.author
                            }
                        })
                    };
                },
                cache: true
            }
        });
        // Publication Search
        $('#publication').select2({
            placeholder: 'Semua tahun terbit...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('getDataPublication') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.publication,
                                id: item.publication
                            }
                        })
                    };
                },
                cache: true
            }
        });
        // Publisher Search
        $('#publisher').select2({
            placeholder: 'Semua penerbit...',
            allowClear: true,
            language: 'id',
            width: 'resolve',
            theme: 'bootstrap4',
            ajax: {
                url: "{{ route('getDataPublisher') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.publisher,
                                id: item.publisher
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
