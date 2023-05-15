@extends('layouts.main')

@section('content')

<div class="container mx-auto px-4 pt-16">
    <!-- Filter -->
    @if( isset($filterData))
        <div class="w-full mb-8 py-3 px-5 bg-gray-600 rounded-md">
            <!-- Regions -->
            <div class="font-bold">Countries :</div>
            <div class="flex justify-start align-middle gap-5 mt-2">
                <a href="{{ route('movies.index') }}">
                    <div class="px-4 py-1 duration-300 hover:-translate-y-1 rounded-full bg-gray-500">
                        All
                    </div>
                </a>
                @foreach ($filterData as $key => $item)
                    <a href="{{ route('movies.region', $key) }}">
                        <div class="px-3 py-1 duration-200 rounded-full @if( $category == $key ) bg-gray-800 underline cursor-default @else bg-gray-500 hover:-translate-y-1 hover:bg-gray-800 cursor-pointer @endif ">
                            {{ $key }}
                        </div>
                    </a>
                @endforeach
            </div>
            
            <!-- Years -->
            <div class="font-bold mt-3">Years :</div>
            <div class="flex flex-wrap justify-start align-middle gap-5 mt-2">
                @foreach ($years as $year)
                    <a href="#">
                        <div class="w-20 text-center py-1 text-sm duration-200 bg-transparent border-2 border-gray-300 hover:-translate-y-1 hover:bg-gray-800 rounded-full cursor-pointer">
                            {{ $year }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif


    <!-- Start Movies -->
    <div class="movies">
        <a href="{{ route('movies.category', $category) }}">
            <h2 class="relative uppercase tracking-wider text-orange-500 text-xl font-bold mb-4 after:content-[''] w-fit
            after:bg-[rgb(2,0,36)] after:bg-gradient-to-r after:from-red-800 after:via-yellow-600 after:to-yellow-500 after:w-[0%] after:left-0 after:-bottom-[3px] 
            after:h-[4px] after:absolute transition-all after:duration-300 hover:after:w-[100%] bg-gradient-to-r  from-amber-500 to-pink-500 bg-clip-text text-transparent">
                {{ $categoryName }} Movies
            </h2>
        </a>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-5 gap-8">
            @foreach ($movies as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </div>
        <div class="hidden" id="category-name" data-category="{{ $category }}"></div>
    </div>
    <!-- End Movies -->


    <!-- Loading (infinite scroll) -->
    <div class="page-load-status text-center py-8">
        <p class="infinite-scroll-request"><i class="fas fa-spinner fa-spin fa-4x"></i></p>
        <p class="infinite-scroll-last text-2xl">End of content</p>
        <p class="infinite-scroll-error text-2xl">No more pages to load</p>
    </div>
</div>

<!-- Scroll down -->
<div class="fixed top-1/2 right-5 animate-bounce duration-500">
    <div id="scroll-down">
        <span class="arrow-down"></span>
        <span id="scroll-title" class="transform rotate-[90deg] pb-10 -translate-y-24">
          Scroll down
        </span>
    </div>
</div>

@endsection


@section('scripts')

    <!-- infinite scroll CDN -->
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>

    <script>
        // Lazy loading image
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.src = entry.target.dataset.image;
                    observer.unobserve(entry.target);
                }
            });
            }, {
            rootMargin: '0px 0px -200px 0px'
        });

        var lazyImages = document.querySelectorAll('.movie_poster');

        lazyImages.forEach(function(image) {
            observer.observe(image);
        });
    </script>

    @if ( isset($filter) && $filter=="region")
        <script>
            // Infinite scroll
            let category = document.getElementById('category-name').getAttribute('data-category');
            let elem = document.querySelector('.grid');
            
            let infScroll = new InfiniteScroll( elem, {
                // options
                path: `/movies/region/${category}/page/@{{#}}`,
                append: '.movie',
                history: false,
                status: '.page-load-status',
            });
            
            // After added new item, lazy load them
            infScroll.on( 'append', function( body, path, items, response ) {
                var lazyImages = document.querySelectorAll('.movie_poster');
            
                lazyImages.forEach(function(image) {
                    observer.observe(image);
                });
            });
        </script>
    @else
        <script>
            // Infinite scroll
            let category = document.getElementById('category-name').getAttribute('data-category');
            let elem = document.querySelector('.grid');
            
            let infScroll = new InfiniteScroll( elem, {
                // options
                path: `/movies/${category}/page/@{{#}}`,
                append: '.movie',
                history: false,
                status: '.page-load-status',
            });
            
            // After added new item, lazy load them
            infScroll.on( 'append', function( body, path, items, response ) {
                var lazyImages = document.querySelectorAll('.movie_poster');
            
                lazyImages.forEach(function(image) {
                    observer.observe(image);
                });
            });
        </script>
    @endif

@endsection