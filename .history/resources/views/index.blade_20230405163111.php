@extends('layouts.main')

@section('style')
  <style>


    .movies-swiper {
      width: 100%;
      height: 100%;
      margin-left: auto;
      margin-right: auto;
    }

    .movies-swiper .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      height: calc((100% - 30px) / 2) !important;

      /* Center slide text vertically */
      display: flex;
      justify-content: center;
      align-items: center;
    }

  </style>
@endsection


@section('content')
    {{-- Popular Movies --}}
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4">Popular Movies</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-10">
                
            </div>
        </div>


        {{-- Now Playing --}}
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4 mt-20">Now Playing</h2>
        {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-10">
            @foreach ($nowPlaying as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"/>
            @endforeach
        </div> --}}

        <!-- Swiper -->
        <div class="w-[2000px] h-[400px] mx-auto">
            <div class="swiper movies-swiper">
            <div class="swiper-wrapper">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" :genres="$genres"/>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- Now Playing --}}
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4 mt-20">Now Playing</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-10">
            @foreach ($nowPlaying as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"/>
            @endforeach
        </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".movies-swiper", {
        slidesPerView: 10,
        grid: {
            rows: 4,
        },
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        });
    </script>

@endsection