@extends('layouts.main')

@section('content')
<div
    data-te-modal-init
    class="fixed top-0 left-0 z-[1055]  h-full w-full overflow-y-auto overflow-x-hidden outline-none"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div
    data-te-modal-dialog-ref
    class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
    <div
        class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
        <div
        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
        <h5
            class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
            id="exampleModalLabel">
            Modal title
        </h5>
        <button
            type="button"
            class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
            data-te-modal-dismiss
            aria-label="Close">
            <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="h-6 w-6">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        </div>
        <div class="relative flex-auto p-4" data-te-modal-body-ref>
        Modal body text goes here.
        </div>
        <div
        class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
        <button
            type="button"
            class="inline-block rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
            data-te-modal-dismiss
            data-te-ripple-init
            data-te-ripple-color="light">
            Close
        </button>
        <button
            type="button"
            class="ml-1 inline-block rounded bg-primary px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
            data-te-ripple-init
            data-te-ripple-color="light">
            Save changes
        </button>
        </div>
    </div>
    </div>
</div>

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
                    <button
                        type="button"
                        class="inline-block rounded bg-primary px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]"
                        data-te-toggle="modal"
                        data-te-target="#exampleModal"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        Launch demo modal
                    </button>
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