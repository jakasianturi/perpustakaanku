@extends('layouts.front')

@section('content')
    <!-- Banner -->
    @if ($banners->count() > 0)
        <div class="container py-5">
            <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($banners as $banner)
                        <li data-target="#bannerCarousel" data-slide-to="{{ $loop->index }}"
                            class="@if ($loop->index == 0) active @endif">
                        </li>
                    @endforeach
                </ol>
                <div class="carousel-inner rounded" style="max-height: 480px">
                    @foreach ($banners as $banner)
                        <div class="carousel-item @if ($loop->index == 0) active @endif"
                            style="background-image: url('{{ isset($banner->background) ? asset('storage/uploads/' . $banner->background) : asset('img/thumbnail.jpg') }}')">
                            <div class="container">
                                <div class="carousel-caption text-center">
                                    <h1 class="carousel-caption--title mb-3 text-white">{{ $banner->title ?? '' }}</h1>
                                    <p class="carousel-caption--description">
                                        {{ $banner->description ?? '' }}
                                    </p>
                                    @if ($banner->button_text)
                                        <a href="{{ $banner->button_url ?? '#' }}"
                                            class="btn btn-primary rounded-pill btn-hovered px-4">{{ $banner->button_text ?? '' }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    @endif
    <!--. End Banner -->
    <!-- Popular -->
    <div id="popular" class="container mt-5">
        <div class="mb-5">
            <h3 class="mb-2 text-black">Buku Terpopuler</h3>
            <span class="divider bg-primary"></span>
        </div>
        @if ($books->total())
            <div class="row popular-book-list">
                @foreach ($books as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-5">
                        <div class="book-list">
                            <a class="book-list__img" href="{{ route('detailBook', $book->slug ?? '') }}">
                                <img src="{{ isset($book->cover) ? asset('storage/uploads/' . $book->cover) : '' }}" />
                            </a>
                            <div class="book-list__body">
                                <h6 class="book-list__body--title"><a
                                        href="{{ route('detailBook', $book->slug ?? '') }}">{{ $book->title }}</a></h6>
                                <a class="book-list__body--category"
                                    href="{{ route('detailCategory', $book->category->slug ?? '') }}">
                                    <p>{{ $book->category->category_name }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $books->links() }}
        @else
            <div class="alert alert-secondary" role="alert">
                <h5>Mohon maaf, daftar buku belum ada.</h5>
            </div>
        @endif
    </div>
    <!--. End Popular -->
    <!-- New Activity -->
    <div id="activity" class="container mt-5">
        <div class="mb-5">
            <h3 class="mb-2 text-black">Aktivitas Terbaru</h3>
            <span class="divider bg-primary"></span>
        </div>
        @if ($news->count() > 0)
            <div class="row justify-content-between">
                <div class="col-md-6 col-xs-12">
                    <div class="card h-100 border-0">
                        <a href="{{ route('detailNews', $last_news->slug ?? '') }}">
                            <img class="card-img-top"
                                src="{{ isset($last_news->thumbnail) ? asset('storage/uploads/' . $last_news->thumbnail) : '' }}"
                                alt="Image" />
                        </a>
                        <div class="card-body">
                            <a class="text-decoration-none" href="{{ route('detailNews', $last_news->slug ?? '') }}">
                                <h5 class="card-title">{{ $last_news->title ?? '' }} </h5>
                            </a>
                            <p class="card-text">
                                {!! \Illuminate\Support\Str::words(strip_tags($last_news->content), $limit = 20, $end = '...') !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 activity-list">
                    @foreach ($news as $list_news)
                        <div class="card border-0 mb-3">
                            <div class="card-horizontal">
                                <a href="{{ route('detailNews', $list_news->slug ?? '') }}">
                                    <img class="card-img-top"
                                        src="{{ isset($list_news->thumbnail) ? asset('storage/uploads/' . $list_news->thumbnail) : '' }}"
                                        alt="Image" />
                                </a>
                                <div class="card-body pt-1">
                                    <a class="text-decoration-none"
                                        href="{{ route('detailNews', $list_news->slug ?? '') }}">
                                        <h6 class="card-title">{{ $list_news->title ?? '' }}</h6>
                                    </a>
                                    <p class="card-text">
                                        {!! \Illuminate\Support\Str::words(strip_tags($list_news->content), $limit = 15, $end = '...') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-secondary" role="alert">
                <h5>Mohon maaf, daftar berita belum ada.</h5>
            </div>
        @endif
    </div>
    <!--. End New Activity -->
@endsection
