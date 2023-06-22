<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $categories = Category::paginate(15);
        return view('welcome', ['categories' => $categories]);
    }
}
