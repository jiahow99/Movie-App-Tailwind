<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;


class SearchDropdown extends Component
{

    public $search = '';

    public function render()
    {
        if( strlen($this->search) >= 2 ){
            $nowPlaying = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search)
            ->json();
        }

        $searchResults = [];

        return view('livewire.search-dropdown', compact('searchResults'));
    }
}
