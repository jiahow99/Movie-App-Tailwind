<div class="modal-background px-52">
    <!-- Search -->
    <div class="search-input relative mt-14 w-fit mx-auto">
        <input 
            type="text" 
            class="pr-80 py-2 pl-4 bg-transparent rounded-full focus:outline-none" 
            placeholder="Search a movie"
            wire:model.debounce.500ms="search"
        >
        <div class="line hidden"></div>
    </div>
    <!-- Results -->
    <div class="search-results">
            @if (strlen($search > 2))
                @if ($searchResults->isNotEmpty())
                    @foreach ($searchResults as $movie)
                        <div class="movie w-full bg-gray-800/70 hover:bg-gray-900 transition-all duration-300 mt-5 px-10 py-4 flex justify-between items-center">
                            <div class="left">
                                <div class="w-[10%]">
                                    <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }}_poster">
                                </div>  
                                <div class="movie-info ml-5 text-left">
                                    <!-- Movie title -->
                                    <h2 class="text-xl font-bold">{{ $movie['title'] }}</h2>
                                    <!-- Movie rating -->
                                    <div class="flex items-center text-gray-400 text-sm">
                                        <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
                                        <span class="ml-1">99</span>
                                        <span class="mx-2">|</span>
                                        <span>
                                            {{ $movie['release_date'] }}
                                        </span>
                                    </div>
                                    <!-- Movie type -->
                                    <div class="text-gray-400">Action type</div>
                                </div>
                            </div>
                            <div class="right">123</div>
                        </div>
                    @endforeach
                @else
                    
                @endif   
                
            @endif
    </div>
    <div class="search-loader absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex justify-center" wire:loading>
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
</div>
