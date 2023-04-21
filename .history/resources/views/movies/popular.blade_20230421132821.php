@extends('layouts.main')

@section('content')
<div class="fixed bottom-5 right-10 rounded-full bg-slate-700 px-5 py-5 z-50 pointer-events-none animate-bounce">
    <i class="fa-solid fa-arrow-down-long text-4xl"></i>
</div>

<div class="container mx-auto px-4 pt-16">
    <div class="popular-actors">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4">Popular Movies</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4  xl:grid-cols-5 gap-8">
            @foreach ($popularMovies as $movie)
                <x-movie-card :movie="$movie">
            @endforeach            
        </div>
    </div>


    <!-- Loading (infinite scroll) -->
    <div class="page-load-status text-center py-8">
        <p class="infinite-scroll-request"><i class="fas fa-spinner fa-spin fa-4x"></i></p>
        <p class="infinite-scroll-last text-2xl">End of content</p>
        <p class="infinite-scroll-error text-2xl">No more pages to load</p>
    </div>
</div>
@endsection


@section('scripts')

    {{-- <!-- infinite scroll CDN -->
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>

    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
            // options
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status',
        });
    </script> --}}


@endsection