<div class="relative">
    <i class="fa-solid fa-magnifying-glass text-white absolute mt-2 ml-3 py-auto text-sm"></i>
    <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 rounded-full w-64 pl-10 py-1" placeholder="Search">
    <div class="search-results absolute w-72 bg-gray-800 rounded-lg mt-2 z-50">
        <ul class="bg-gray-700 text-sm">

            {{-- Search results --}}
            @if ($search >= 2)
                @if ($searchResults->isNotEmpty())
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movie.show', $result['id']) }}" class="hover:bg-gray-800 px-3 py-3
                            duration-200 flex items-center">
                                <img src="https://image.tmdb.org/t/p/w500/{{ $result['poster_path'] }}" class="w-20" alt="{{ $result['title'] }}_image">
                                <span class="ml-4">{{ $result['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="border-b border-gray-700">
                        <span class="block px-3 py-3">No results for "{{ $search }}"</span> 
                    </li>
                @endif
            @endif

        </ul>
    </div>
</div>