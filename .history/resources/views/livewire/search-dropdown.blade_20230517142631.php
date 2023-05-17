<div id="search-modal-container"
x-data="{ isOpen: true }" 
>
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

                        <div class="movie w-full bg-gray-800/70 hover:bg-gray-900 transition-all duration-300 mt-5 px-10 py-4 flex">
                            <div class="w-2/12">
                                <img src="{{ asset('image/frozen2.jpg') }}" alt="">
                            </div>  
                            <div class="movie-info ml-5 text-left">
                                <!-- Movie title -->
                                <h2 class="text-2xl font-bold">Movie Name</h2>
                                <!-- Movie rating -->
                                <div class="flex items-center text-gray-400 text-sm">
                                    <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
                                    <span class="ml-1">99</span>
                                    <span class="mx-2">|</span>
                                    <span>
                                        12 Mar 2023
                                    </span>
                                </div>
                                <!-- Movie type -->
                                <div class="text-gray-400">Action type</div>
                            </div>
                        </div>
                        
                    @else
                        
                    @endif   
                    
                @endif
        </div>
        <div class="search-loader flex justify-center" wire:loading>
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>
    <!-- Close Btn -->
    <span id="search-close" class="close absolute top-10 right-20 text-gray-300 cursor-pointer hover:rotate-90 hover:scale-150 transition duration-200" x-on:click="loginModal = false; resetInput();">
        <i class="fa-solid fa-xmark fa-2xl"></i>
    </span>
</div>