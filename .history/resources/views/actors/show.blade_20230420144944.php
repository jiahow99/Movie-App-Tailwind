@extends('layouts.main')

@section('style')
<style>
    .swiper-slide {
      background: transparent;
    }

    .timeline {
        padding: 50px;
    }
    .timeline ul {
        padding: 0;
    }
    .timeline .default-line {
        content: "";
        position: absolute;
        left: 50%;
        width: 4px;
        background: #bdc3c7;
        min-height: 1000px;
    }
    .timeline .draw-line {
        width: 4px;
        height: 0;
        position: absolute;
        left: 50%;
        background: #2ecc71;
    }
    .timeline ul li {
        list-style-type: none;
        position: relative;
        width: 2px;
        margin: 0 auto;
        height: 100px;
        background: transparent;
    }
    .timeline ul li.in-view {
      transition: 0.125s ease-in-out, background-color 0.2s ease-out, color 0.1s ease-out, border 0.1s ease-out;
    }
    .timeline ul li.in-view::before {
        content: "";
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-image: url("https://sg0duxoli5-flywheel.netdna-ssl.com/wp-content/themes/inspired_elearning_theme/images/check-dark.svg");
        background-color: #2ecc71;
        background-size: 20px 20px;
        background-repeat: no-repeat;
        background-position: center;
        transition: 0.125s ease-in-out, background-color 0.2s ease-out, color 0.1s ease-out, border 0.1s ease-out;
    }
    .timeline ul li::before {
        content: "";
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: inherit;
        background: #bdc3c7;
        transition: all 0.4s ease-in-out;
    }
</style>
@endsection

@section('content')
<div x-data="{ readMore: false }">
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">

            <div class="flex flex-col xl:flex-row">
                <img src="{{ $actor['profile_path'] }}" class="w-full h-full md:w-3/5 md:h-3/5 lg:w-2/5 lg:h-2/5 xl:w-1/5 xl:h-1/5 mx-auto xl:mx-0" alt="actor_image">
                <div class="mt-6 xl:mt-0 xl:ml-24 xl:pr-10">
                    <div class="xl:flex justify-between">

                        <div>
                            <h2 class="text-4xl font-semibold">{{ $actor['name'] }}</h2>
                            <div class="flex items-center text-gray-400 mt-2">
                                <i class="fa-solid fa-user-check"></i>
                                <span class="ml-1">{{ $actor['birthday'] }} ({{ $actor['age'] }} years old) in {{ $actor['place_of_birth'] }}</span>
                            </div>
                        </div>


                        <div class="mt-5 xl:mt-0">
                            <div class="text-gray-400 font-bold xl:text-right">Connect :</div>
                            <div class="xl:flex justify-center gap-6 mt-3">
                                @isset($actor['facebook'])
                                    <a href="{{ $actor['facebook'] }}" title="Facebook" target="_blank"><i class="fa-brands fa-facebook text-4xl text-gray-500 hover:text-white duration-300"></i></a>
                                @endisset
                                @isset($actor['twitter'])
                                    <a href="{{ $actor['twitter'] }}" title="Twitter" target="_blank"><i class="fa-brands fa-twitter text-4xl text-gray-500 hover:text-white duration-300"></i></i></a>
                                @endisset
                                @isset($actor['instagram'])
                                    <a href="{{ $actor['instagram'] }}" title="Instagram" target="_blank"><i class="fa-brands fa-instagram text-4xl text-gray-500 hover:text-white duration-300"></i></a>
                                @endisset
                            </div>
                        </div>
                    </div>


                    <p class="text-gray-300 mt-8 ">
                        {{ $actor['biography'] }}
                        @isset($actor['read_more'])
                            <span
                            style="display: none"
                            x-show="readMore"
                            x-transition:enter="transition ease-out duration-500" 
                            x-transition:enter-start="opacity-0 transform -translate-y-10" 
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-10"
                            >{{ $actor['read_more'] }}</span>
    
                            <span x-on:click="readMore = !readMore" x-show="!readMore" class="mx-2 font-bold text-teal-600 hover:underline hover:text-teal-900 duration-200 ease-out underline-offset-4 cursor-pointer">Read more</span>
                            <span style="display: none" x-on:click="readMore = !readMore" x-show="readMore" class="mx-2 font-bold text-teal-600 hover:underline hover:text-teal-900 duration-200 ease-out underline-offset-4 cursor-pointer">Read less</span>
                        @endisset
                    </p>
                    

                    <h4 class="mt-12 font-semibold">Known For</h4>
                    <div class="swiper-buttons select-none mt-5 mb-3">
                        <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-left text-black text-xl md:text-2xl xl:text-2xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 credits-prev"></i></div>
                        <div class="w-1/12 inline mr-2"><i class="fa-solid fa-caret-right text-black text-xl md:text-2xl xl:text-2xl cursor-pointer rounded-full bg-slate-600 px-1 xl:px-2 hover:text-white hover:bg-slate-700 duration-150 credits-next"></i></div>
                    </div>
                    <div class="max-w-screen w-auto xl:w-[1000px] h-fit flex justify-center align-middle">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach ($credits as $credit)
                                    <div class="swiper-slide m-auto">
                                        <a href="{{ route('movie.show', $credit['id']) }}">
                                            <img loading="lazy" class="known_for_movie transition ease-in-out duration-500 hover:scale-105 hover:opacity-60  "
                                                src="{{ asset('image/movie_placeholder.jpg') }}" data-src="{{ $credit['poster_path'] }}" alt="movie_poster">
                                            <div class="mt-2 text-center">{{ $credit['title'] }}</div>   
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>

            {{-- Cast history --}}
            <div class="mt-6 cast-history w-2/6 relative overflow-hidden pb-28">
                <div>
                    <div class="timeline">
                        <ul>
                            <span class="default-line"></span>
                            <span class="draw-line"></span>
                            <li>
                                <div class="mr-32">123</div>
                                <div class="ml-32 text-4xl">123</div>
                            </li>
                            <li>
                                <div class="ml-32 text-4xl">123</div>
                            </li>
                            <li>
                                <div class="ml-32 text-4xl">123</div>
                            </li>
                            <li>
                                <div class="ml-32 text-4xl">123</div>
                            </li>
                        </ul>
                    </div>
                  </div>
            </div>

        </div>
    </div>
</div>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
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
        breakpoints: {
            1280: {
                slidesPerView: 4.5,
                slidesPerGroup : 3,
            },
            768: {
                slidesPerView: 3.5,
                slidesPerGroup : 2,
            },
            320: {
                slidesPerView: 2.5,
                slidesPerGroup : 2,
            },
        }
    });

    // Timeline Scroll Section
    // --------------------------------------------------------------
    var items = $(".timeline li"),
    timelineHeight = $(".timeline ul").height(),
    greyLine = $('.default-line'),
    lineToDraw = $('.draw-line');

    // sets the height that the greyLine (.default-line) should be according to `.timeline ul` height

    // run this function only if draw line exists on the page
    if(lineToDraw.length) {
    $(window).on('scroll', function () {

        // Need to constantly get '.draw-line' height to compare against '.default-line'
        var redLineHeight = lineToDraw.height(),
        greyLineHeight = greyLine.height(),
        windowDistance = $(window).scrollTop(),
        windowHeight = $(window).height() / 2,
        timelineDistance = $(".timeline").offset().top;

        if(windowDistance >= timelineDistance - windowHeight) {
        line = windowDistance - timelineDistance + windowHeight;

        if(line <= greyLineHeight) {
            lineToDraw.css({
            'height' : line + 20 + 'px'
            });
        }
        }

        // This takes care of adding the class in-view to the li:before items
        var bottom = lineToDraw.offset().top + lineToDraw.outerHeight(true);
        items.each(function(index){
        var circlePosition = $(this).offset();

        if(bottom > circlePosition.top) {				
            $(this).addClass('in-view');
        } else {
            $(this).removeClass('in-view');
        }
        });	
    });
    }

    // Lazy loading image
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.src = entry.target.dataset.src;
                observer.unobserve(entry.target);
            }
        });
        }, {
        // Set bottom margin to 50% of viewport height
        rootMargin: '0px 0px -200px 0px'
    });

    var lazyImages = document.querySelectorAll('.known_for_movie');
    lazyImages.forEach(function(image) {
        observer.observe(image);
    });


    // var divHeight = document.querySelector(".timeline").offsetHeight;
    // document.querySelector(".default-line").style.height = divHeight + 150 + "px";
    // console.log(divHeight);
</script>



@endsection