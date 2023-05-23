@extends('layouts.main')


@section('content')

    <div class="container mx-auto px-4 pt-16">
        <!-- Filters -->
        <x-filter :type="$type" :filterData="$filterData"/>

        <!-- Trending Tv -->
        <div class="trending-tv">
            <div class="flex justify-between align-middle">
                <a href="{{ route('tv.category', 'trending') }}">
                    <h2 class="relative uppercase tracking-wider text-orange-500 text-2xl font-bold mb-4 after:content-[''] 
                    after:bg-[rgb(2,0,36)] after:bg-gradient-to-r after:from-red-800 after:via-yellow-600 after:to-yellow-500 after:w-[0%] after:left-0 after:-bottom-[3px] 
                    after:h-[4px] after:absolute transition-all after:duration-300 hover:after:w-[100%] bg-gradient-to-r  from-amber-500 to-pink-500 bg-clip-text text-transparent">
                        Trending TV 
                    </h2>
                </a>
                <div class="swiper-buttons my-auto select-none">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 nowPlaying-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 nowPlaying-next"></i></div>
                </div>
            </div>
            <!-- Start Swiper -->
            <div class="swiper nowPlaying h-fit">
                <div class="swiper-wrapper">
                    @foreach ($trendingTv[0] as $tv)
                    <div class="swiper-slide">
                        <x-movie-card :type="$type" :movie="$tv" />
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper nowPlaying h-fit">
                <div class="swiper-wrapper">
                    @foreach ($trendingTv[1] as $tv)
                    <div class="swiper-slide">
                        <x-movie-card :type="$type" :movie="$tv" />
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End Swiper -->
        </div>


        <!-- Popular Tv -->
        <div class="popular-tv mt-10">
            <div class="flex justify-between align-middle ">
                <a href="{{ route('tv.category', 'popular') }}">
                    <h2 class="relative uppercase tracking-wider text-2xl font-bold mb-4 after:content-[''] 
                    after:bg-[rgb(2,0,36)] after:bg-gradient-to-r after:from-red-800 after:via-yellow-600 after:to-yellow-500 after:w-[0%] after:left-0 after:-bottom-[3px] 
                    after:h-[4px] after:absolute transition-all after:duration-300 hover:after:w-[100%] bg-gradient-to-r  from-amber-500 to-pink-500 bg-clip-text text-transparent">
                        Popular Tv
                    </h2>
                </a>
                <div class="swiper-buttons my-auto select-none">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-next"></i></div>
                </div>
            </div>
            <!-- Start Swiper -->
            <div class="swiper popularMovies h-fit">
                <div class="swiper-wrapper">
                    @foreach ($popularTv[0] as $tv)
                    <div class="swiper-slide">
                        <x-movie-card :type="$type" :movie="$tv" />
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper popularMovies h-fit">
                <div class="swiper-wrapper">
                    @foreach ($popularTv[1] as $tv)
                    <div class="swiper-slide">
                        <x-movie-card :type="$type" :movie="$tv" />
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- End Swiper -->
        </div>


        <!-- Top Rated Tv -->
        <div class="toprated-tv mt-10">
            <div class="flex justify-between align-middle">
                <a href="{{ route('tv.category', 'top_rated') }}">
                    <h2 class="relative uppercase tracking-wider text-orange-500 text-2xl font-bold mb-4 after:content-[''] 
                    after:bg-[rgb(2,0,36)] after:bg-gradient-to-r after:from-red-800 after:via-yellow-600 after:to-yellow-500 after:w-[0%] after:left-0 after:-bottom-[3px] 
                    after:h-[4px] after:absolute transition-all after:duration-300 hover:after:w-[100%] bg-gradient-to-r  from-amber-500 to-pink-500 bg-clip-text text-transparent">
                        Top Rated Tv
                    </h2>
                </a>
                <div class="swiper-buttons my-auto select-none">
                    <div class="w-1/12 inline mr-3"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-3xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 popular-next"></i></div>
                </div>
            </div>
            <!-- Start Swiper -->
            <div class="swiper popularMovies h-fit">
                <div class="swiper-wrapper">
                    @foreach ($topRatedTv[0] as $tv)
                    <div class="swiper-slide">
                        <x-movie-card :type="$type" :movie="$tv" />
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper popularMovies h-fit">
                <div class="swiper-wrapper">
                    @foreach ($topRatedTv[1] as $tv)
                    <div class="swiper-slide">
                        <x-movie-card :type="$type" :movie="$tv" />
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
        function toggleFilter() {
            $('#filter-menu').slideToggle();
        }

    </script>

@endsection