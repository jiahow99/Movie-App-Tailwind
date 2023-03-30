@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4">Popular Movies</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-10">
                @foreach ($popularMovies as $movie)
                    <div class="mt-8">
                        <a href="#">
                            <img src="{{ asset('image/parasite.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">{{ Parasite }}</a>
                        </div>
                        <div class="flex items-center text-gray-400">
                            <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
                            <span class="ml-1">85%</span>
                            <span class="mx-2">|</span>
                            <span>Feb 20, 2020</span>
                        </div>
                        <div class="text-gray-400">
                            Action , Thriller , Comedy
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection