<?php

namespace App\Http\Livewire;

use Livewire\Component;

public $search = '';

class SearchDropdown extends Component
{
    public function render()
    {
        return view('livewire.search-dropdown');
    }
}
