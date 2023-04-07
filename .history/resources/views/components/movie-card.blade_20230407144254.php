 <div class="mt-8">
    <a href="{{ route('movie.show', $movie['id']) }}">
        <img src="{{ asset('image/movie_placeholder.jpg') }}" data-image="{{ $movie['poster_path'] }}" class="movie_poster transition ease-in-out duration-500 hover:scale-105 hover:opacity-60 swiper-lazy" alt="parasite" loading="lazy">
    </a>
    <div class="mt-2">
        <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">{{ $movie['title'] }}</a>
    </div>
    <div class="flex items-center text-gray-400">
        <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
        <span class="ml-1">{{ $movie['vote_average'] }}</span>
        <span class="mx-2">|</span>
        <span>
            @isset($movie['release_date'])
                {{ $movie['release_date'] }}
            @else
                To be confirmed
            @endisset
        </span>
    </div>
    <div class="text-gray-400">
        {{ $movie['genres'] }}
    </div>
</div>