@extends('layouts.main')


@section('style')
<style>
    .swiper-slide {
        background: transparent;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection


@section('content')

    {{-- Popular Movies --}}
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <div class="flex justify-between">
                <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4">Popular Movies</h2>
                <div class="swiper-buttons my-auto">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-gray-800 text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-white px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 thumbnail-prev no-swiping"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-gray-800 text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-white px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 thumbnail-next no-swiping"></i></div>
                </div>
            </div>
            {{-- Swiper --}}
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($popularMovies as $movie)
                    <div class="swiper-slide">
                        <x-movie-card :movie="$movie" :genres="$genres"/>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- End Swiper --}}
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
        var swiper = new Swiper(".mySwiper", {
        slidesPerView: 5,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        });
    </script>
@endsection