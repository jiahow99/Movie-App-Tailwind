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
    <div class="container mx-auto px-4 pt-16">
        <!-- Filters -->
        <div class="w-full mb-8 py-3 px-5 bg-gray-600 rounded-md">
            <!-- Regions -->
            <div class="flex lg:hidden justify-between">
                <h1 class="text-xl my-auto font-bold tracking-wider">Filters</h1>
                <div id="filter-toggler">
                    <input type="checkbox" id="checkbox">
                    <label for="checkbox" class="toggle">
                        <div class="bars" id="bar1"></div>
                        <div class="bars" id="bar2"></div>
                        <div class="bars" id="bar3"></div>
                    </label>
                </div>
            </div>
            <div id="filter-menu" class="hidden lg:block">
                @isset($regions)
                    <div class="font-bold">Countries :</div>
                    <div class="flex flex-wrap justify-start align-middle gap-5 mt-2">
                        <a href="{{ route('movies.index') }}">
                            <div class="px-4 py-1 duration-300 hover:-translate-y-1 rounded-full bg-gray-500">
                                All
                            </div>
                        </a>
                        @foreach ($regions as $key => $item)
                            <a href="{{ route('movies.region', $key) }}">
                                <div class="w-28 text-center py-1 text-sm duration-200 rounded-full bg-transparent border-2 border-gray-300 hover:-translate-y-1 hover:bg-gray-800 text-slate-300 hover:text-white">
                                    {{ $key }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>


        <!-- Now Playing Movies -->
        <div class="now-playing">
            <div class="flex justify-between align-middle">
                <a href="{{ route('movies.category', 'now_playing') }}">
                    <h2 class="relative uppercase tracking-wider text-orange-500 text-2xl font-bold mb-4 after:content-[''] 
                    after:bg-[rgb(2,0,36)] after:bg-gradient-to-r after:from-red-800 after:via-yellow-600 after:to-yellow-500 after:w-[0%] after:left-0 after:-bottom-[3px] 
                    after:h-[4px] after:absolute transition-all after:duration-300 hover:after:w-[100%] bg-gradient-to-r  from-amber-500 to-pink-500 bg-clip-text text-transparent">
                        Now Playing
                    </h2>
                </a>
                <div class="swiper-buttons my-auto select-none">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 nowPlaying-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 nowPlaying-next"></i></div>
                </div>
            </div>
            <!-- Start Swiper -->
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
            <!-- End Swiper -->
        </div>


        <!-- Popular Movies -->
        <div class="popular-movies mt-10">
            <div class="flex justify-between align-middle">
                <a href="{{ route('movies.category', 'popular') }}">
                    <h2 class="relative uppercase tracking-wider text-orange-500 text-2xl font-bold mb-4 after:content-[''] 
                    after:bg-[rgb(2,0,36)] after:bg-gradient-to-r after:from-red-800 after:via-yellow-600 after:to-yellow-500 after:w-[0%] after:left-0 after:-bottom-[3px] 
                    after:h-[4px] after:absolute transition-all after:duration-300 hover:after:w-[100%] bg-gradient-to-r  from-amber-500 to-pink-500 bg-clip-text text-transparent">
                        Popular Movies
                    </h2>
                </a>
                <div class="swiper-buttons my-auto select-none">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-next"></i></div>
                </div>
            </div>
            <!-- Start Swiper -->
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
            <!-- End Swiper -->
        </div>

    
        <!-- Top Rated Movies -->
        <div class="toprated-movies mt-10">
            <div class="flex justify-between align-middle">
                <a href="{{ route('movies.category', 'top_rated') }}">
                    <h2 class="relative uppercase tracking-wider text-orange-500 text-2xl font-bold mb-4 after:content-[''] 
                    after:bg-[rgb(2,0,36)] after:bg-gradient-to-r after:from-red-800 after:via-yellow-600 after:to-yellow-500 after:w-[0%] after:left-0 after:-bottom-[3px] 
                    after:h-[4px] after:absolute transition-all after:duration-300 hover:after:w-[100%] bg-gradient-to-r  from-amber-500 to-pink-500 bg-clip-text text-transparent">
                        Top Rated Movies
                    </h2>
                </a>
                <div class="swiper-buttons my-auto select-none">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-next"></i></div>
                </div>
            </div>
            <!-- Start Swiper -->
            <div class="swiper popularMovies">
                <div class="swiper-wrapper">
                    @foreach ($topRated[0] as $movie)
                    <div class="swiper-slide">
                        <x-movie-card :movie="$movie" />
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper popularMovies">
                <div class="swiper-wrapper">
                    @foreach ($topRated[1] as $movie)
                    <div class="swiper-slide">
                        <x-movie-card :movie="$movie" />
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End Swiper -->
        </div>
    </div>


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  
    <!-- Initialize Swiper -->
    <script>
        // Swiper for "Popular Movies"
        var popularSwiper = new Swiper(".popularMovies", {
            rewind: true,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".popular-next",
                prevEl: ".popular-prev",
            },
            breakpoints: {
                1280: {
                    slidesPerView: 5,
                    slidesPerGroup: 5
                },
                768: {
                    slidesPerView: 3,
                    slidesPerGroup: 3
                },
                320: {
                    slidesPerView: 2,
                    slidesPerGroup: 2
                }
            }
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
            breakpoints: {
                1280: {
                    slidesPerView: 5,
                    slidesPerGroup: 5
                },
                768: {
                    slidesPerView: 3,
                    slidesPerGroup: 3
                },
                320: {
                    slidesPerView: 2,
                    slidesPerGroup: 2
                }
            }
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
            rootMargin: '0px 0px -100px 0px'
        });
        var lazyImages = document.querySelectorAll('.movie_poster');
        lazyImages.forEach(function(image) {
            observer.observe(image);
        });


        // Toggle filter menu
        $('#filter-toggler').click(function() {
            $('#filter-menu').slideToggle();
        });

        // function toggleFilter() {
        //     $('#filter-menu').slideToggle();
        // }

    </script>

@endsection