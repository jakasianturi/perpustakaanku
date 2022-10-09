@extends('layouts.front')

@section('content')
<!-- About Us -->
<main role="main">
  <div id="about-us" class="container mt-5">
    <div class="hero rounded">
      <div class="bg-about-us"
        style="background-image: url('{{ isset($about->about_thumbnail) ? asset('storage/uploads/'. $about->about_thumbnail) :  asset('img/thumbnail.jpg') }}'); height: 480px;">
        <div class="overlay">
          <div class="container">
            <h1 class="text-white font-weight-bold text-center "
              style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);">
              {{ $about->about_title ?? '' }}</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container col-md-8 py-5">
      <article class="text-justify">
        {!! $about->about_content ?? '' !!}
      </article>
    </div>
  </div>
</main>
<!--. End About Us -->
@endsection