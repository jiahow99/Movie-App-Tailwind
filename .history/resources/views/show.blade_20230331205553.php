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

                        @foreach ($movie['credits']['cast'] as $crew)
                            <div>
                                {{-- <div>{{ $crew[''] }}</div> --}}
                                <div class="text-sm text-gray-400">Screenplay, Director, Story</div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="mt-12">
                    <button class="flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-10 py-4 
                    hover:bg-orange-600 transition ease-in-out duration-300 space-x-3">
                        <i class="fa-solid fa-circle-play"></i>
                        <span class="font-bold">Play</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-10">
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/actor1.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Real Name</a>
                    </div>
                    <div class="text-gray-400">John Smith</div>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/actor2.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Real Name</a>
                    </div>
                    <div class="text-gray-400">John Smith</div>
                </div><div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/actor3.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Real Name</a>
                    </div>
                    <div class="text-gray-400">John Smith</div>
                </div><div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/actor4.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Real Name</a>
                    </div>
                    <div class="text-gray-400">John Smith</div>
                </div>  <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/actor5.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
                    </a>
                    <div class="mt-2">
                        <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Real Name</a>
                    </div>
                    <div class="text-gray-400">John Smith</div>
                </div>
            </div>
        </div>
    </div>

    <div class="Thumbnail border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Screenshots</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap:0 xl:gap-10">
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/image1.jpg') }}" alt="parasite_thumbnail">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/image2.jpg') }}" alt="parasite_thumbnail">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/image3.jpg') }}" alt="parasite_thumbnail">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/image4.jpg') }}" alt="parasite_thumbnail">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/image5.jpg') }}" alt="parasite_thumbnail">
                    </a>
                </div>
                <div class="mt-8">
                    <a href="#">
                        <img src="{{ asset('image/image6.jpg') }}" alt="parasite_thumbnail">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection