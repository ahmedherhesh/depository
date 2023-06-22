<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemReturn extends Component
{
    public $itemReturn;
    /**
     * Create a new component instance.
     */
    public function __construct($itemReturn)
    {
        $this->itemReturn = $itemReturn;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-return');
    }
}
