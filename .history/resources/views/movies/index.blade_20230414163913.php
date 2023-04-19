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
                <div class="swiper-buttons my-auto select-none">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-next"></i></div>
                </div>
            </div>
            {{-- Swiper --}}
            <div class="swiper popularMovies">
                <div class="swiper-wrapper">
                    @foreach ($popularMovies[0] as $movie)
                    <div class="swiper-slide">
                        <x-movie-card :movie="$movie" />
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper popularMovies">
                <div class="swiper-wrapper">
                    @foreach ($popularMovies[1] as $movie)
                    <div class="swiper-slide">
                        <x-movie-card :movie="$movie" />
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- End Swiper --}}
        </div>


        <div class="now-playing mt-10">
            <div class="flex justify-between">
                <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4">Now Playing</h2>
                <div class="swiper-buttons my-auto select-none">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 nowPlaying-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 nowPlaying-next"></i></div>
                </div>
            </div>
            {{-- Swiper --}}
            <div class="swiper nowPlaying">
                <div class="swiper-wrapper">
                    @foreach ($nowPlaying[0] as $movie)
                    <div class="swiper-slide">
                        <x-movie-card :movie="$movie" />
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper nowPlaying">
                <div class="swiper-wrapper">
                    @foreach ($nowPlaying[1] as $movie)
                    <div class="swiper-slide">
                        <x-movie-card :movie="$movie" />
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- End Swiper --}}
        </div>
    </div>


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  
    <!-- Initialize Swiper -->
    <script>
        // Swiper for "Popular Movies"
        var popularSwiper = new Swiper(".popularMovies", {
            slidesPerView: 5,
            rewind: true,
            slidesPerGroup: 5,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".popular-next",
                prevEl: ".popular-prev",
            },
        });

        // Swiper for "Now Playing"
        var nowPlayingSwiper = new Swiper(".nowPlaying", {
            slidesPerView: 5,
            rewind: true,
            slidesPerGroup: 5,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".nowPlaying-next",
                prevEl: ".nowPlaying-prev",
            },
        });

        
        // Lazy loading image
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.src = entry.target.dataset.image;
                    console.log("Intersected" + entry.target);
                    observer.unobserve(entry.target);
                }
            });
            }, {
            // Set bottom margin to 50% of viewport height
            rootMargin: '0px 0px -200px 0px'
        });

        var lazyImages = document.querySelectorAll('.movie_poster');
        lazyImages.forEach(function(image) {
            observer.observe(image);
        });

    </script>
@endsection