<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Depository;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = session()->get('user');
        $depots = Depository::query();
        if (!in_array($user->role, ['super-admin', 'admin']))
            $depots = $depots->whereId($user->depot_id);
        $depots = $depots->get();
        return view('reports', compact('depots'));
    }
}
