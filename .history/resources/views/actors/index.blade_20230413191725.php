@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-actors">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4">Popular Movies</h2>
        <div class="grid grid-cols-5 gap-8">
            @foreach ($popular_actors as $actor)
                <div class="actor mt-8">
                    {{-- profile image --}}
                    <a href="{{ route('actor.show', $actor['id']) }}">
                        <img src="{{ $actor['profile_path'] }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="actor_image">
                    </a>
                    {{-- name --}}
                    <div class="mt-2">
                        <a href="#" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                        <div class="text-sm truncate text-gray-400">Iron Man, Avengers, Avengers: Infinity Wardasdasdsaadasdasdadas</div>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>


    <!-- Pagination (click) -->
    {{-- <div class="pagination flex justify-between my-12">
        @if ($previous)
            <a href="/actors/page/{{ $previous }}" >Prev</a>
        @endif
        @if ($next)
            <a href="/actors/page/{{ $next }}" >Next</a>
        @endif
    </div> --}}


    <!-- Loading (infinite scroll) -->


</div>
@endsection


@section('scripts')
<!-- infinite scroll CDN -->
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    let elem = document.querySelector('.grid');
    let infScroll = new InfiniteScroll( elem, {
        // options
        path: '/actors/page/@{{#}}',
        append: '.actor',
    });

    // element argument can be a selector string
    //   for an individual element
    let infScroll = new InfiniteScroll( '.container', {
    // options
    });
</script>


@endsection