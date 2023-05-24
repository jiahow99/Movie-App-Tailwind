@extends('layouts.main')

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
        videoSrc: 'https://www.youtube.com/embed/{{ $season['youtubeURL'] }}?autoplay=',
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


    <!-- Start Tv Info -->
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col xl:flex-row">
            <!-- Poster -->
            <img src="{{ $season['poster_path'] }}" class="w-96 h-fit mx-auto xl:mx-0" alt="{{ $season['name'] }}">
            <div class="mt-6 xl:mt-0 xl:ml-24">
                <h2 class="text-4xl font-semibold">{{ $season['name'] }} ({{ $season['air_year'] }})</h2>
                <div class="flex items-center text-gray-400 mt-1">
                    <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
                    <span class="ml-1">{{ $tv['vote_average'] }}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $season['air_date'] }}</span>
                </div>
                <!-- Overview -->
                <p class="text-gray-300 mt-8">
                    {{ $tv['overview'] }}
                </p>
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
                    href="https://www.youtube.com/watch?v={{ $season['youtubeURL'] }}" 
                    class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-10 py-4 
                    hover:bg-orange-600 transition ease-in-out duration-300 space-x-3 w-fit" style="display: none"
                    x-show="isMobile"
                    target="_blank">
                        <i class="fa-solid fa-circle-play"></i>
                        <span class="font-bold">Play Trailer</span>
                    </a>
                </div>
                <!-- Start episodes -->
                @isset($season['episodes'])
                    <div class="mt-8 xl:w-[900px] h-fit relative">
                        <h3 class="text-lg font-bold text-slate-400 tracking-wide">Featured seasons :</h3>
                        <!-- Swiper Start -->
                        <div class="mt-3 swiper movie-collections">
                            <div class="swiper-wrapper">
                                @foreach ($season['episodes'] as $episode)
                                <div class="swiper-slide">
                                    <a href="#">
                                        <img class="duration-300 hover:scale-105" src="{{ $episode['still_path'] }}" alt="tv_poster" loading="lazy">
                                        <div class="mt-2">{{ $episode['name'] }}</div>
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
                <!-- End season -->
            </div>
        </div>
    </div>
    <!-- End Tv Info -->


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
    // Swiper for Actor
    var swiper = new Swiper(".swiper-actors", {
        slidesPerView: 2.5,
        spaceBetween: 20,
        slidesPerGroup: 2,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: ".actor-next",
            prevEl: ".actor-prev",
        },
        breakpoints: {
            // when window width is <= 768px (tablet)
            768: {
                slidesPerView: 3.5,
                spaceBetween: 30
            },
            // when window width is <= 1024px (desktop)
            1024: {
                slidesPerView: 4.5,
                spaceBetween: 30
            }
        }
    });


    // Swiper for Thumbnails
    var swiper_thumbnails = new Swiper(".swiper-thumbnail", {
        direction: 'horizontal',
        loop: true,
        navigation: {
            nextEl: ".thumbnail-next",
            prevEl: ".thumbnail-prev",
        },
    });


    // Swiper for Screenshots
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


    // Swiper for Movie Collections
    var swiper_collections = new Swiper(".movie-collections", {
        slidesPerView: 2,
                spaceBetween: 20,  
        navigation: {
            nextEl: '.collection-next',
            prevEl: '.collection-prev',
        },
        breakpoints: {
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