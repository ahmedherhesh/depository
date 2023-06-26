<?php

namespace App\Http\Controllers;

use App\Models\Depository;
use Illuminate\Http\Request;

class ReportController extends MasterController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $depots = Depository::query();
        if (!$this->isAdmin())
            $depots = $depots->whereId($this->user()->depot_id);
        $depots = $depots->get();
        return view('reports', compact('depots'));
    }
}
