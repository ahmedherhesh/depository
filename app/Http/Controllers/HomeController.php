<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Delivery;
use App\Models\Item;
use App\Models\ItemReturn;
use Illuminate\Http\Request;

class HomeController extends MasterController
{
    function index()
    {
        $items = Item::query();
        $items_count = $items;
        $deliveries_count = Delivery::query();
        $returnedItems_count = ItemReturn::query();
        if (!$this->isAdmin()) {
            $items_count = $items_count->allowed();
            $deliveries_count = $deliveries_count->allowed();
            $returnedItems_count = $returnedItems_count->allowed();
        }
        $items = $items->paginate(20);
        $items_count = $items_count->count();
        $deliveries_count = $deliveries_count->count();
        $returned_items_count = $returnedItems_count->count();
        return view('welcome', compact('items', 'items_count', 'deliveries_count', 'returned_items_count'));
    }
}
