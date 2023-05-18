<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Filter extends Component
{
    public $filterData;
    public $category;
    public $chosenYear;

    /**
     * Create a new component instance.
     */
    public function __construct($filterData, $category=null, $chosenYear=null)
    {
        $this->filterData = $filterData;
        $this->category = $category;
        $this->chosenYear = $chosenYear;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter');
    }
}
