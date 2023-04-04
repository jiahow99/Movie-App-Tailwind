<div 
class="relative" 
x-data="{ isOpen: true }" 
@click.away="isOpen = false"
>
    <i class="fa-solid fa-magnifying-glass text-white absolute mt-2 ml-3 py-auto text-sm"></i>
    <input 
    wire:model.debounce.500ms="search"  
    type="text" 
    class="bg-gray-800 rounded-full w-64 pl-10 py-1" 
    placeholder="Search"
    x-ref="search"
    x-on:click="isOpen = true"
    x-on:keydown="isOpen = true"
    @keydown.tab.window="$refs.search.focus()"
    @keydown.escape.window="isOpen = false"
    @keydown.shift.tab="isOpen = false"
    >
    {{-- Spinner --}}
    <div wire:loading class="spinner absolute top-0 right-0 mt-4 mr-7"></div>
    <div class="search-results absolute w-72 bg-gray-800 rounded-lg mt-2 z-50" >
        <ul class="bg-gray-700">
            
            {{-- Search results --}}
            @if (strlen($search) >= 2)
                @if ($searchResults->isNotEmpty())
                    @foreach ($searchResults as $result)
                        <li 
                        class="border-b border-gray-700" 
                        x-show="isOpen"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        >
                            <a href="{{ route('movie.show', $result['id']) }}" class="hover:bg-gray-800 px-3 py-3
                            duration-200 flex items-center">
                                <img src="
                                    @isset($result['poster_path'])
                                        https://image.tmdb.org/t/p/w500/{{ $result['poster_path'] }}
                                    @else
                                        https://placehold.co/600x400
                                    @endisset
                                " class="w-20" alt="{{ $result['title'] }}_image">
                                <span class="ml-4">{{ $result['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li class="border-b border-gray-700" x-show="isOpen">
                        <span class="block px-3 py-3">No results for "{{ $search }}"</span> 
                    </li>
                @endif
            @endif

        </ul>
    </div>
</div>