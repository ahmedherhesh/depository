<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = session()->get('user');
        $deliveries = Delivery::query();
        if (!in_array($user->role, ['super-admin', 'admin']))
            $deliveries = $deliveries->allowed();
        $deliveries = $deliveries->latest()->get();
        return view('reports', compact('deliveries'));
    }
}
