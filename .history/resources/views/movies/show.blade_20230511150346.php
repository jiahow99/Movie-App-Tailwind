@extends('layouts.show')

@section('style')

<!-- Toastr -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Lightgallery -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/css/lightgallery.min.css" integrity="sha512-F2E+YYE1gkt0T5TVajAslgDfTEUQKtlu4ralVq78ViNxhKXQLrgQLLie8u1tVdG2vWnB3ute4hcdbiBtvJQh0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .swiper-screenshots .swiper-slide {
        text-align: center;
        background: transparent;
        height: calc((80% - 30px) / 2) !important;
    }

    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      display: flex;
      justify-content: center;
      align-items: center;
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
    <div x-data="{
        isMobile: window.innerWidth < 1280,
        isDesktop: window.innerWidth >= 1280,
        isOpen: false,
        autoplay: 0,
        videoSrc: 'https://www.youtube.com/embed/{{ $movie['youtubeURL'] }}?autoplay=',
    }">

    <!-- Video Modal -->
    <div class="fixed w-full h-full inset-x-0 " 
    x-show="isOpen" 
    x-transition.duration.500ms.ease-in-out.origin-top
    >
        <div class="mx-auto relative 2xl:mt-14 2xl:w-[900px] 2xl:h-[500px] -translate-y-5 xl:mt-0 lg:w-[950px] lg:h-[600px] lg:mt-60 md:w-[700px] md:h-[400px] w-[350px] h-[200px]" 
        @click.outside="isOpen = autoplay = false;">
            <iframe class="w-full h-full" x-bind:src="videoSrc+autoplay" 
            allow="autoplay; encrypted-media" allowfullscreen ></iframe>
        </div>
    </div>


    <!-- Start Movie Info -->
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col xl:flex-row">
            <!-- Poster -->
            <img src="{{ $movie['poster_path'] }}" class="w-96 h-fit mx-auto xl:mx-0" alt="{{ $movie['title'] }}">
            <div class="mt-6 xl:mt-0 xl:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }} ({{ $movie['release_year'] }})</h2>
                <div class="flex items-center text-gray-400 mt-1">
                    <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
                    <span class="ml-1">{{ $movie['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <!-- Rated -->
                    @isset( $movie['is_rated'] )
                        <span class="ml-5 mr-3">
                            <!-- Rate good -->
                            <i class="fa-solid fa-thumbs-up fa-xl @if ($movie['is_rated'] === 'good') text-green-700 scale-125 @else text-gray-700 pointer-events-none @endif"></i>
                        </span>
                        <span >
                            <!-- Rate bad -->
                            <i class="fa-solid fa-thumbs-down fa-xl @if ($movie['is_rated'] === 'bad') text-red-500 scale-125 @else text-gray-700 pointer-events-none @endif"></i>
                        </span>
                    <!-- Not Rated Yet -->
                    @else
                        <span class="ml-5 mr-3">
                            <!-- Rate good -->
                            <i onclick="document.getElementById('rate-good').submit()" class="fa-solid fa-thumbs-up fa-xl text-green-700 hover:scale-125 cursor-pointer"></i>
                        </span>
                        <span >
                            <!-- Rate bad -->
                            <i onclick="document.getElementById('rate-bad').submit()" class="fa-solid fa-thumbs-down fa-xl text-red-500 hover:scale-125 cursor-pointer"></i>
                        </span>
                    @endisset
                    <!-- Hidden Form (Post Request) -->
                    <form id="rate-good" action="{{ route('movie.rate', [$movie['id'], 'good']) }}" method="POST" class="hidden">
                        @csrf
                        @method('POST')
                    </form>
                    <form id="rate-bad" action="{{ route('movie.rate', [$movie['id'], 'bad']) }}" method="POST" class="hidden">
                        @csrf
                        @method('POST')
                    </form>
                </div>
                <!-- Genres -->
                <div class="text-gray-400 mt-2">
                    {{ $movie['genres'] }}
                </div>
                <!-- Overview -->
                <p class="text-gray-300 mt-8">
                    {{ $movie['overview'] }}
                </p>
                <!-- Crew -->
                <div class="mt-12">
                    <div class="text-white font-semibold">Featured Cast</div>
                    <div class="flex mt-4">

                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($loop->index < 3)
                                <div class="mr-8">
                                    <div>{{ $crew['name'] }}</div>
                                    <div class="text-sm text-gray-400">{{ $crew['department'].', '.$crew['job'] }}</div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
                <!-- "Play trailer" -->
                <div class="mt-12">
                    <!-- Desktop -->
                    <span 
                    class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-10 py-4 
                    hover:bg-orange-600 transition ease-in-out duration-300 space-x-3 w-fit" 
                    x-show="isDesktop"
                    x-on:click="isOpen=true; autoplay=true"
                    >
                        <i class="fa-solid fa-circle-play"></i>
                        <span class="font-bold">Play Trailer</span>
                    </span>
                    <!-- Mobile -->
                    <a 
                    href="https://www.youtube.com/watch?v={{ $movie['youtubeURL'] }}" 
                    class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-10 py-4 
                    hover:bg-orange-600 transition ease-in-out duration-300 space-x-3 w-fit" style="display: none"
                    x-show="isMobile"
                    target="_blank">
                        <i class="fa-solid fa-circle-play"></i>
                        <span class="font-bold">Play Trailer</span>
                    </a>
                </div>

                <!-- Start Movie Collections -->
                @isset($movie['collection_movies'])
                    <div class="mt-8 xl:w-[900px] h-fit relative">
                        <h3 class="text-lg font-bold text-slate-400 tracking-wide">Previous Series :</h3>
                        <!-- Swiper Start -->
                        <div class="mt-3 swiper movie-collections">
                            <div class="swiper-wrapper">
                                @foreach ($movie['collection_movies'] as $movieCollection)
                                <div class="swiper-slide">
                                    <a href="{{ route('movie.show', $movieCollection['id']) }}">
                                        <img class="duration-300 hover:scale-105" src="{{ $movieCollection['poster_path'] }}" alt="movie_poster" loading="lazy">
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Prev -->
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 xl:-translate-x-1/2 z-50">
                            <i class="collection-prev fa-solid fa-circle-chevron-left text-6xl opacity-40 hover:opacity-80 cursor-pointer text-slate-50  rounded-full"></i>
                        </div>
                        <!-- Next -->
                        <div class="absolute right-0 top-1/2 transform -translate-y-1/2 xl:translate-x-1/2 z-50">
                            <i class="collection-next fa-solid fa-circle-chevron-right text-6xl opacity-40 hover:opacity-80 cursor-pointer text-slate-50  rounded-full"></i>
                        </div>
                    </div>
                @endisset
                <!-- End Movie Collections -->

            </div>
        </div>
    </div>
    <!-- End Movie Info -->


    <!-- Start Actors -->
    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <!-- Swi[er] -->
            <div class="relative w-full">
                <div class="swiper swiper-actors">
                    <div class="swiper-wrapper">
                      @foreach ($movie['credits']['cast'] as $key => $actor)
                        <div class="swiper-slide flex-col">
                            <div class="actor-image cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $key * 200 }}" data-aos-once="true">
                                <img src="{{ $actor['profile_path'] }}" alt="actor_name">
                                <div class="actor-name text-2xl whitespace-nowrap">{{ $actor['name'] }}</div>
                            </div>
                            <div class="text-gray-400 text-left">{{ $actor['character'] }}</div>
                        </div>
                      @endforeach
                    </div>
                </div>
                <!-- Prev -->
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2  z-50">
                    <i class="actor-prev fa-solid fa-circle-chevron-left text-6xl cursor-pointer text-white opacity-60 hover:opacity-100 rounded-full"></i>
                </div>
                <!-- Next -->
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2  z-50">
                    <i class="actor-next fa-solid fa-circle-chevron-right text-6xl cursor-pointer text-white opacity-60 hover:opacity-100 rounded-full"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- End Actors -->


    <!-- Start Thumbnails -->
    <div class="Thumbnail border-b border-gray-800" 
        x-data="
        { 
            imageModalOpen: false, 
            imageSrc: '', 
            navigation: false,
        }"
    >
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Screenshots</h2>
            <!-- Thumbnails (Desktop) -->
            <div class="swiper-screenshots mt-6 relative hidden xl:block overflow-hidden" x-on:mouseenter="navigation = true" x-on:mouseleave="navigation = false">
                <div class="swiper-wrapper">
                    @foreach ($movie['images']['backdrops'] as $index=>$image)
                        <div class="swiper-slide" 
                        x-on:click=" 
                        imageSrc = 'https://image.tmdb.org/t/p/original/{{ $image['file_path'] }}';
                        imageModalOpen = true;
                        activeIndex = $event.target.getAttribute('data-index');
                        swiper_thumbnails.slideTo(activeIndex);
                        "
                        >
                            <img src="https://image.tmdb.org/t/p/w500/{{ $image['file_path'] }}" alt="{{ $movie['title'] }}_thumbnail" data-index="{{ $index }}">
                        </div>
                     @endforeach
                </div>
                <!-- Prev -->
                <div class="screenshot-prev absolute h-4/5 top-0 left-0 z-50 bg-white bg-opacity-30 hover:bg-opacity-100 px-2 flex rounded-full transition duration-300 cursor-pointer" style="display: none;" x-show="navigation" x-transition>
                    <i class="fa-solid fa-arrow-left text-black text-5xl my-auto"></i>
                </div>
                <!-- Next -->
                <div class="screenshot-next absolute h-4/5 top-0 right-0 z-50 bg-white bg-opacity-30 hover:bg-opacity-100 px-2 flex rounded-full transition duration-300 cursor-pointer" style="display: none;" x-show="navigation" x-transition>
                    <i class="fa-solid fa-arrow-right text-black text-5xl my-auto"></i>
                </div>
            </div>

            <!-- Thumbnails (Mobile) -->
            <div id="gallery" class="grid grid-cols-1 md:grid-cols-2 gap-10 xl:hidden">
                @foreach ($movie['images']['backdrops'] as $image)
                    <a href="https://image.tmdb.org/t/p/original/{{ $image['file_path'] }}">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $image['file_path'] }}" alt="movie_thumbnails" loading="lazy">
                    </a>
                @endforeach
            </div>
=        </div>
        
        <!--  Thumbnail Modal -->
        <div class="fixed inset-0 z-20 bg-black/70 flex items-center justify-center select-none" style="display: none" x-show="imageModalOpen" @keydown.escape.window="imageModalOpen = false" x-transition>
            <div class="relative w-1/2">
                <!-- Swiper -->
                <div class="swiper swiper-thumbnail">
                    <div class="swiper-wrapper">
                        @foreach ($movie['images']['backdrops'] as $image)
                            <div class="swiper-slide">
                                <img src="https://image.tmdb.org/t/p/w780/{{ $image['file_path'] }}" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Prev -->
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-[120%] z-30">
                    <i class="thumbnail-prev fa-solid fa-caret-left text-gray-800 text-xl md:text-2xl xl:text-6xl cursor-pointer rounded-full bg-white px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-160"></i>
                </div>
                <!-- Next -->
                <div class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-[120%] z-30">
                    <i class="thumbnail-next fa-solid fa-caret-right text-gray-800 text-xl md:text-2xl xl:text-6xl cursor-pointer rounded-full bg-white px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150"></i>
                </div>
            </div>
            <!-- Close button -->
            <div class="absolute top-8 right-20 z-20 cursor-pointer text-4xl">
                <i class="fa-sharp fa-solid fa-xmark hover:rotate-90 hover:scale-150 duration-300" x-on:click="imageModalOpen = false;"></i>
            </div>
        </div>

    </div>
    <!-- End Screenshots -->

</div>


<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- LightGallery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.1/lightgallery.min.js" integrity="sha512-dSI4QnNeaXiNEjX2N8bkb16B7aMu/8SI5/rE6NIa3Hr/HnWUO+EAZpizN2JQJrXuvU7z0HTgpBVk/sfGd0oW+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // Actors swiper
    var swiper = new Swiper(".swiper-actors", {
      slidesPerView: 5,
      spaceBetween: 20,
    });


    // Thumbnails swiper
    var swiper_thumbnails = new Swiper(".swiper-thumbnail", {
        direction: 'horizontal',
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            type: "progressbar",
        },
        navigation: {
            nextEl: ".thumbnail-next",
            prevEl: ".thumbnail-prev",
        },
        keyboard: {
            enabled: true,
            onlyInViewport: false,
        },
    });


    // Screenshots swiper
    var swiper_screenshots = new Swiper(".swiper-screenshots", {
        slidesPerView: 3,
        loop: true,
        grid: {
            rows: 2,
            fill: 'row',
        },
        spaceBetween: 30,
        navigation: {
            nextEl: ".screenshot-next",
            prevEl: ".screenshot-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });


    // Movie Collections swiper
    var swiper_collections = new Swiper(".movie-collections", {
        slidesPerGroup: 2,
        spaceBetween: 30,
        navigation: {
            nextEl: '.collection-next',
            prevEl: '.collection-prev',
        },
        breakpoints: {
            // when window width is <= 640px (mobile)
            400: {
                slidesPerView: 2,
                spaceBetween: 20,   
            },
            // when window width is <= 768px (tablet)
            768: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            // when window width is <= 1024px (desktop)
            1024: {
                slidesPerView: 4,
                spaceBetween: 40
            }
        }
    });


    // Toastr configuration
    toastr.options = {
        "closeButton": false,
        "positionClass": "toast-top-center",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };


    // Light gallery (screenshots)
    let gallery = document.getElementById('gallery');
    lightGallery(gallery, {
        controls: true,
    })
    
</script>

<!-- Trigger toastr -->
@if (session('Error'))
    <script>
        toastr.error("{{ session('Error') }}", "Error rating movie");
    </script>
@endif

@if (session('Success'))
    <script>
        toastr.success('{{ session('Success') }}');
    </script>
@endif

@endsection