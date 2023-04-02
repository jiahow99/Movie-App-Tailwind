<?php

namespace App\Http\Livewire;

use Livewire\Component;


class SearchDropdown extends Component
{

    public $search = '';

    public function render()
    {

        $searchResults = [];

        return view('livewire.search-dropdown', compact('searchResults'));
    }
}
