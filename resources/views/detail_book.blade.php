@extends('layouts.front')

@section('content')
    <main role="main">
        <div class="container mt-5">
            <div class="row">
                <!-- Book Detail -->
                <div id="book-detail" class="col-md-8">
                    <div class="mb-5">
                        <h3 class="pb-3 mb-2 text-black">{{ $book->title ?? '' }}</h3>
                        <span class="divider bg-primary"></span>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-mw-sm-3 mb-md-auto">
                            <div class="book-cover">
                                <img src="{{ isset($book->cover) ? asset('storage/uploads/' . $book->cover) : '' }}" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <table class="table table-borderless book-detail-list">
                                <tbody>
                                    <tr>
                                        <td class="label" style="width: 40%">ID Buku</td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $book->book_id ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label" style="width: 40%">Judul Buku</td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $book->title ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label" style="width: 40%">Penulis</td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $book->author ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label" style="width: 40%">Penerbit</td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $book->publisher ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label" style="width: 40%">Tahun Terbit</td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $book->publication ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label" style="width: 40%">ISBN</td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $book->isbn ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label" style="width: 40%">Stok</td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $book->stock ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="label" style="width: 40%">Kategori</td>
                                        <td style="width: 2%">:</td>
                                        <td style="width: 58%">{{ $book->category->category_name ?? '' }}</td>
                                    </tr>
                                    @guest
                                        <tr>
                                            <td class="label" style="width: 40%">
                                                <form class="" action="{{ route('member.borrows.create') }}">
                                                    <input type="hidden" class="form-control" name="id_book" id="id_book"
                                                        value="{{ $book->id ?? '' }}" />
                                                    <button type="submit" class="btn btn-primary mt-2">Pinjam Buku</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @else
                                        @if (Auth::user()->user_role !== 'admin')
                                            <tr>
                                                <td class="label" style="width: 40%">
                                                    <form class="" action="{{ route('member.borrows.create') }}">
                                                        <input type="hidden" class="form-control" name="id_book" id="id_book"
                                                            value="{{ $book->id ?? '' }}" />
                                                        <button type="submit" class="btn btn-primary mt-2">Pinjam Buku</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endguest
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="book-description">
                        <h6>Deskripsi :</h6>
                        <article class="text-justify">
                            {!! $book->description ?? '' !!}
                        </article>
                    </div>
                </div>
                <!--. End Book Detail -->
                <aside class="col-md-4">
                    <div class="p-3 mb-3 bg-light rounded">
                        <h5>Karya Terkait</h5>
                        <ol class="list-unstyled mb-0">
                            @foreach ($related_books as $book)
                                <li><a class="text-decoration-none"
                                        href="{{ route('detailBook', $book->slug) }}">{{ $book->title }}</a></li>
                            @endforeach
                        </ol>
                    </div>
                </aside>
            </div>
        </div>
    </main>
@endsection
