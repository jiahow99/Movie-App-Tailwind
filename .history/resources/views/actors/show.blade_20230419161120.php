@extends('layouts.main')

@section('style')
<style>
    .swiper-slide {
      background: transparent;
    }

</style>
@endsection

@section('content')
<div x-data="{
    isOpen: false,
    autoplay: 0,
}">

    {{-- Video Modal --}}
    {{-- <div class="fixed w-full h-full inset-x-0 " 
    x-show="isOpen" 
    x-transition.duration.500ms.ease-in-out.origin-top
    >
        <div class="mx-auto relative 2xl:mt-14 2xl:w-[900px] 2xl:h-[500px] -translate-y-5 xl:mt-0 lg:w-[950px] lg:h-[600px] lg:mt-60 md:w-[700px] md:h-[400px] w-[350px] h-[200px]" 
        @click.outside="isOpen = autoplay = false;">
            <iframe class="w-full h-full" x-bind:src="videoSrc+autoplay" 
            allow="autoplay; encrypted-media" allowfullscreen ></iframe>
        </div>
    </div> --}}

    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col xl:flex-row">
            <img src="{{ $actor['profile_path'] }}" class="w-96 h-96 mx-auto xl:mx-0" alt="actor_image">
            <div class="mt-6 xl:mt-0 xl:ml-24 xl:pr-10">
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-4xl font-semibold">{{ $actor['name'] }}</h2>
                        <div class="flex items-center text-gray-400 mt-2">
                            <i class="fa-solid fa-user-check"></i>
                            <span class="ml-1">{{ $actor['birthday'] }} ({{ $actor['age'] }} years old) in {{ $actor['place_of_birth'] }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-400 font-bold text-right">Connect :</div>
                        <div class="flex justify-center gap-6 mt-3">
                            <a href="#" title="Facebook"><i class="fa-brands fa-facebook text-4xl text-gray-500 hover:text-white duration-300"></i></a>
                            <a href="#" title="Facebook"><i class="fa-brands fa-instagram text-4xl text-gray-500 hover:text-white duration-300"></i></a>
                            <a href="#" title="Facebook"><i class="fa-brands fa-twitter text-4xl text-gray-500 hover:text-white duration-300"></i></a>
                            <a href="#" title="Facebook"><i class="fa-brands fa-reddit text-4xl text-gray-500 hover:text-white duration-300"></i></a>
                        </div>
                    </div>
                </div>

                <p class="text-gray-300 mt-8">
                    {{ $actor['biography'] }}
                </p>
                
                <h4 class="mt-12 font-semibold">Known For</h4>
                <div class="swiper-buttons select-none mt-5 mb-3">
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-2xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 credits-prev"></i></div>
                    <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-2xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 credits-next"></i></div>
                </div>
                <div class="w-[900px] h-fit">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($credits as $credit)
                                <div class="swiper-slide m-auto">
                                    <img loading="lazy" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60  "
                                        src="{{ $credit['poster_path'] }}" alt="movie_poster">
                                    <div class="mt-2 text-center">{{ $credit['title'] }}</div>   
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                {{-- <div class="mt-12">
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
                </div> --}}

            </div>            
        </div>
    </div>

    

    {{-- <div class="movie-cast border-b border-gray-800">
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
    </div> --}}

    {{-- <div class="Thumbnail border-b border-gray-800" 
    x-data="{ imageModalOpen: false, imageSrc: '' }">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Screenshots</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap:0 xl:gap-10">

                @foreach (array_reverse($movie['images']['backdrops']) as $index=>$image)
                    @if ($loop->index < 6)
                        <div class="mt-8 cursor-pointer" 
                        x-on:click=" 
                        imageSrc = 'https://image.tmdb.org/t/p/original/{{ $image['file_path'] }}';
                        imageModalOpen = true;
                        activeIndex = $event.target.getAttribute('data-index');
                        swiper.slideTo(activeIndex);
                        "
                        >
                            <img src="https://image.tmdb.org/t/p/w500/{{ $image['file_path'] }}" alt="{{ $movie['title'] }}_thumbnail" data-index="{{ $index }}">
                        </div>
                    @endif
                @endforeach
                
            </div>
        </div> --}}

        {{-- Thumbnail Modal --}}
        {{-- <div class="fixed inset-0 z-20 bg-black/70" style="display: none" x-show="imageModalOpen" x-transition>
            <div class="absolute top-8 right-20 z-20 cursor-pointer text-4xl ">
                <i class="fa-sharp fa-solid fa-xmark hover:rotate-90 hover:scale-150 duration-300" x-on:click="imageModalOpen = false"></i>
            </div>
            <div class="flex justify-center align-middle w-12/12 md:w-11/12 xl:w-8/12 mx-auto mt-72 md:mt-56 xl:mt-36" @click.outside="swiper.slidePrev();">
                <div class="my-auto mx-2 w-1/5"><i class="fa-solid fa-caret-left text-gray-800 text-xl md:text-2xl xl:text-4xl cursor-pointer rounded-full bg-white px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 thumbnail-prev no-swiping"></i></div>
                <div class="swiper mySwiper" x-show="imageModalOpen" style="display: none">
                    <div class="swiper-wrapper">
                    @foreach (array_reverse($movie['images']['backdrops']) as $index=>$image)
                        <div class="swiper-slide">
                            <img src="https://image.tmdb.org/t/p/original/{{ $image['file_path'] }}">
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="my-auto mx-2 w-1/5"><i class="fa-solid fa-caret-right text-gray-800 text-xl md:text-2xl xl:text-4xl cursor-pointer rounded-full bg-white px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 thumbnail-next no-swiping"></i></div>
            </div>
        </div> --}}
    {{-- </div> --}}
</div>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4.5,
        slidesPerGroup : 3,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },  
        grabCursor: true,
        navigation: {
            nextEl: ".credits-next",
            prevEl: ".credits-prev",
        },
    });
</script>

@endsection