<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemDelivery extends Component
{
    public $delivery;
    public $qty;
    /**
     * Create a new component instance.
     */
    public function __construct($delivery,$qty)
    {
        $this->delivery = $delivery;
        $this->qty = $qty;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.item-delivery');
    }
}
