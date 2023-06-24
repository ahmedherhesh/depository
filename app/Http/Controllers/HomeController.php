<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends MasterController
{
    function index()
    {
        $items = Item::query();
        if (!$this->isAdmin())
            $items = $items->allowed();
        $items = $items->paginate(18);
        return view('welcome', ['items' => $items]);
    }
}
