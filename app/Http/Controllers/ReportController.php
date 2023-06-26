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
        $depositories = Depository::query();
        if (!$this->isAdmin())
            $depositories = $depositories->whereId($this->user()->depot_id);
        $depositories = $depositories->get();
        if ($request->inventory == 1)
            return view('reports.inventory', compact('depositories'));
        return view('reports.operations', compact('depositories'));
    }
}
