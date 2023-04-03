@extends('layouts.main')

@section('content')
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
                    {{-- <a href="https://www.youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-10 py-4 
                    hover:bg-orange-600 transition ease-in-out duration-300 space-x-3 w-fit" target="_blank">
                        <i class="fa-solid fa-circle-play"></i>
                        <span class="font-bold">Play</span>
                    </a> --}}
                    <button>Play</button>
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

    <div class="Thumbnail border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Screenshots</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap:0 xl:gap-10">

                @foreach (array_reverse($movie['images']['backdrops']) as $image)
                    @if ($loop->index < 6)
                        <div class="mt-8">
                            <img src="https://image.tmdb.org/t/p/w500/{{ $image['file_path'] }}" alt="parasite_thumbnail">
                        </div>
                    @endif
                @endforeach
                
            </div>
        </div>
    </div>
@endsection