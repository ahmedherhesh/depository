<?php

namespace App\Http\Controllers;

class MasterController extends Controller
{
    public function user()
    {
        return session()->get('user');
    }
    public function isAdmin()
    {
        if (in_array($this->user()->role, ['super-admin', 'admin']))
            return true;
        return false;
    }
}
