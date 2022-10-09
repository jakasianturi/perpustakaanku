@extends('layouts.front')

@section('content')
    <!-- Book Collection -->
    <main role="main">
        <div id="collection" class="container mt-5">
            <div class="mb-5">
                <h3 class="mb-2 text-black">Hasil Pencarian</h3>
                <span class="divider bg-primary"></span>
            </div>
            @if ($books->total())
                <div class="alert alert-success" role="alert">
                    <h5>Hasil pencarian untuk: {{ $request['query_search'] ?? '' }}</h5>
                </div>
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
                    <h5>Mohon maaf, kami tidak menemukan buku "{{ $request['query_search'] ?? '' }}".</h5>
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
