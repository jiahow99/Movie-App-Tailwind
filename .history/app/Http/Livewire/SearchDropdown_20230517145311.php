<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;


class SearchDropdown extends Component
{

    public $search = '';

    public function render()
    {
        $searchResults = [];

        if( strlen($this->search) >= 2 )
        {
            $searchResults = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/movie?query='.$this->search.'&primary_release_year=2023')
            ->json()['results'];
        }

        $searchResults = collect($searchResults)->take(7); // Convert to collection

        return view('livewire.search-dropdown', compact('searchResults'));
    }
}
