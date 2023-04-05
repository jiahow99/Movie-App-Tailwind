 <div class="mt-8">
    <a href="{{ route('movie.show', $movie['id']) }}">
        <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
    </a>
    <div class="mt-2">
        <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">{{ $movie['title'] }}</a>
    </div>
    <div class="flex items-center text-gray-400">
        <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
        <span class="ml-1">{{ $movie['vote_average']*10 }}%</span>
        <span class="mx-2">|</span>
        <span>
            @isset($movie['release_date'])
                {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}
            @else
                To be confirmed
            @endisset
        </span>
    </div>
    <div class="text-gray-400">
        @foreach ($movie['genre_ids'] as $genre)
            {{ $genres->get($genre) }}
            @if(!$loop->last)
                ,
            @endif
        @endforeach
    </div>
</div>