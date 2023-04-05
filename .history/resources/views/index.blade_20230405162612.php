@extends('layouts.main')

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
        <div class="w-[1200px] h-[700px] mx-auto">
            <div class="swiper movies-swiper">
            <div class="swiper-wrapper">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" :genres="$genres"/>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>




    </div>
@endsection

@foreach ($popularMovies as $movie)
    <x-movie-card :movie="$movie" :genres="$genres"/>
@endforeach