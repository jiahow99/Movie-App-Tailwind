@extends('layouts.main')

@section('content')
<div x-data="{
    isMobile: window.innerWidth < 1280,
    isDesktop: window.innerWidth >= 1280,
    isOpen: false,
    autoplay: 0,
    videoSrc: 'https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}?autoplay=',
}">

    {{-- Video Modal --}}
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

    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col xl:flex-row xl:mx-0">
            <img src="{{ "https://image.tmdb.org/t/p/w500/".$movie['poster_path'] }}" class="w-96 mx-auto xl:mx-0" alt="parasite">
            <div class="mt-6 xl:mt-0 xl:ml-24">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }} ({{ \Carbon\Carbon::parse($movie['release_date'])->year }})</h2>
                <div class="flex items-center text-gray-400">
                    <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
                    <span class="ml-1">{{ $movie['vote_average']*10 }}%</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $movie['overview'] }}
                </p>

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

                <div class="mt-12">
                    {{-- Desktop "Play Trailer" --}}
                    <span 
                    class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-10 py-4 
                    hover:bg-orange-600 transition ease-in-out duration-300 space-x-3 w-fit" 
                    x-show="isDesktop"
                    x-on:click="isOpen=true; autoplay=true"
                    >
                        <i class="fa-solid fa-circle-play"></i>
                        <span class="font-bold">Play Trailer</span>
                    </span>
                    {{-- Mobile "Play Trailer" --}}
                    <a 
                    href="https://www.youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" 
                    class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-10 py-4 
                    hover:bg-orange-600 transition ease-in-out duration-300 space-x-3 w-fit" 
                    x-show="isMobile"
                    target="_blank">
                        <i class="fa-solid fa-circle-play"></i>
                        <span class="font-bold">Play Trailer</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-10">

                @foreach ($movie['credits']['cast'] as $cast)
                    @if ($loop->index < 5) 
                        <div class="mt-8">
                            <a href="#">
                                <img src="https://image.tmdb.org/t/p/w500/{{ $cast['profile_path'] }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
                            </a>
                            <div class="mt-2">
                                <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">{{ $cast['name'] }}</a>
                            </div>
                            <div class="text-gray-400">{{ $cast['character'] }}</div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>

    <div class="Thumbnail border-b border-gray-800" 
    x-data="{ imageModalOpen: false, imageSrc: '', activeImage: null, swiper: null }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Screenshots</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap:0 xl:gap-10" x-on:click="activeImage = $event.target.src; swiper && swiper.slideTo($event.target.parentNode.getAttribute('data-index') - 1)">

                @foreach (array_reverse($movie['images']['backdrops']) as $image)
                    @if ($loop->index < 6)
                        <div class="mt-8 cursor-pointer" 
                        x-on:click=" 
                        imageSrc = 'https://image.tmdb.org/t/p/original/{{ $image['file_path'] }}';
                        imageModalOpen = true;
                        ">
                            <img src="https://image.tmdb.org/t/p/w500/{{ $image['file_path'] }}" alt="{{ $movie['title'] }}_thumbnail">
                        </div>
                    @endif
                @endforeach
                
            </div>
        </div>

        {{-- Thumbnail Modal --}}
        <div class="fixed inset-0 z-20 bg-black/70" x-show="imageModalOpen" x-transition>
            <div class="absolute top-5 right-12 z-20 cursor-pointer text-4xl ">
                <i class="fa-sharp fa-solid fa-xmark hover:rotate-90 hover:scale-150 duration-300" x-on:click="imageModalOpen = false"></i>
            </div>
            <div class="flex justify-center align-middle w-8/12 mx-auto mt-36">
                <div class="my-auto mx-5"><i class="fa-solid fa-caret-left text-gray-800 text-4xl cursor-pointer rounded-full bg-white px-2 hover:text-white hover:bg-slate-700 duration-150 thumbnail-prev no-swiping"></i></div>
                <div class="swiper mySwiper" x-show="imageModalOpen" style="display: none" x-init="swiper = new Swiper($el, swiperOptions)">
                    <div class="swiper-wrapper">
                    @foreach (array_reverse($movie['images']['backdrops']) as $image)
                        <div class="swiper-slide"><img src="https://image.tmdb.org/t/p/original/{{ $image['file_path'] }}" tabindex="-1"></div>
                    @endforeach
                    </div>
                </div>
                <div class="my-auto mx-5"><i class="fa-solid fa-caret-right text-gray-800 text-4xl cursor-pointer rounded-full bg-white px-2 hover:text-white hover:bg-slate-700 duration-150 thumbnail-next no-swiping"></i></div>
            </div>
        </div>
    </div>
</div>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
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
        preventClicks: true,
        preventClicksPropagation: true,
        noSwipingSelector: '.no-swiping',
    });
</script>

@endsection