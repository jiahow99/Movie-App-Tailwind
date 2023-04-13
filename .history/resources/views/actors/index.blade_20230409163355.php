@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-actors">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4">Popular Movies</h2>
        <div class="grid grid-cols-5 gap-8">
            @foreach ($popular_actors as $actor)
                <div class="actor mt-8">
                    {{-- profile image --}}
                    <a href="#">
                        <img src="{{ asset('image/actor1.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="actor_image">
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

</div>
@endsection