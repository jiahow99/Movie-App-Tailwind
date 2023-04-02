<div class="relative">
    <i class="fa-solid fa-magnifying-glass text-white absolute mt-2 ml-3 py-auto text-sm"></i>
    <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 rounded-full w-64 pl-10 py-1" placeholder="Search">
    <div class="search-results absolute w-64 bg-gray-800 rounded-lg mt-2">
        <ul class="bg-gray-700 text-sm">
            
            @isset($searchResults)
                @foreach ($searchResults as $result)
                    <li class="border-b border-gray-700">
                        <a href="#" class="block hover:bg-gray-800 px-3 py-3 duration-200">{{ $result['title'] }}</a>
                    </li>
                @endforeach
            @endisset
            
        </ul>
    </div>
</div>