<div class="w-full mb-8 py-3 px-5 bg-gray-600/50 rounded-md">
    <!-- Regions -->
    <div class="flex lg:hidden justify-between">
        <h1 class="text-xl my-auto font-bold tracking-wider">Filters</h1>
        <div id="filter-toggler" class="bg-gray-700 px-3 py-2 rounded-lg" onclick="toggleFilter()">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <div id="filter-menu" class="hidden lg:block">
        <!-- Regions -->
        @isset($filterData['regions'])
            <div class="font-bold">Countries :</div>
            <div class="flex flex-wrap justify-start align-middle gap-5 mt-2">
                <a href="{{ route('movies.index') }}">
                    <div class="px-4 duration-300 hover:-translate-y-1 rounded-full border-2 border-gray-300">
                        All
                    </div>
                </a>
                @foreach ($filterData['regions'] as $key => $item)
                    <a href="{{ route('movies.region', $key) }}">
                        <div class="w-28 text-center py-1 text-sm duration-200 rounded-full @if( isset($category) && $category == $key ) bg-gradient-to-r from-yellow-600 to-red-600 font-bold cursor-default shadow-lg @else bg-transparent border-2 border-gray-300 hover:-translate-y-1 hover:bg-gray-800 text-slate-300 hover:text-white  @endif ">
                            {{ $key }}
                        </div>
                    </a>
                @endforeach
            </div>
        @endisset
        
        <!-- Years -->
        @isset( $filterData['years'] )
            <div class="font-bold mt-3">Years :</div>
            <div class="flex flex-wrap justify-start align-middle gap-5 mt-2">
                @foreach ($filterData['years'] as $year)
                    <a href="{{ route('movies.region', ['region'=> $category, 'year' => $year]) }}">
                        <div class="w-20 text-center py-1 text-sm duration-200 rounded-full @if( $year == $chosenYear ) bg-gradient-to-r from-yellow-600 to-red-600 font-bold cursor-default shadow-lg @else bg-transparent border-2 border-gray-300 hover:-translate-y-1 hover:bg-gray-800 text-slate-300 hover:text-white @endif">
                            {{ $year }}
                        </div>
                    </a>
                @endforeach
            </div>
        @endisset
    </div>
</div>