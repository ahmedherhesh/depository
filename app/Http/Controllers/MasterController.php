<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->user = session()->get('user') ;
    }
}
