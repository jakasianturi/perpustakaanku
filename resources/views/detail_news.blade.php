@extends('layouts.front')

@section('content')
<main role="main">
  <div id="news" class="container mt-5">
    <div class="hero rounded">
      <div class="bg-news"
        style="background-image: url('{{ isset($news->thumbnail) ? asset('storage/uploads/'. $news->thumbnail) :  asset('img/thumbnail.jpg') }}'); height: 480px;">
        <div class="overlay">
          <div class="container">
            <h1 class="text-white font-weight-bold text-center "
              style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
              {{ $news->title ?? '' }}</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container col-md-8 py-5">
      <p>Penulis: <span class="font-weight-bold">{{ $news->user->name ?? '' }}</span></p>
      <article class="text-justify">
        {!! $news->content ?? '' !!}
      </article>
    </div>
  </div>
</main>
@endsection