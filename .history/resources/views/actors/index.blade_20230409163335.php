@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-16">
    <div class="popular-actors">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mb-4">Popular Movies</h2>
        <div class="grid grid-cols-5 gap-8">
            @foreach ($popular_actors as $item)
                {{ $item[0] }}
            @endforeach
            {{-- {{ dd($popular_actors) }} --}}
            
            
        </div>
    </div>

</div>
@endsection